<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\Plant;
use App\Services\PlantDataParser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DetailController extends Controller
{
    public function show($id)
    {
        // 1. Pull the manually entered plant along with any existing detail matrix row
        $plant = Plant::with('detail')->findOrFail($id);

        // 2. Dynamic DB Populating Interception
        if (!$plant->detail) {

            // Call internal method to trigger Gemini API matching the manually filled plant name
            $plantData = $this->fetchFromGemini($plant->plant_name); 

            if ($plantData) {
                // Parse and save the API response data into the database
                $this->store($id, $plantData);
                
                // CRITICAL: Refresh relation data so it links up correctly before rendering
                $plant->load('detail');
            }
        }  

        // 3. Send the fully populated model structure straight to your blade view
        return view('frontend.detail', compact('plant'));
    }

    /**
     * Fetch optimization data matrix from Gemini API
     */
    private function fetchFromGemini($plantName)
    {
       
        $prompt = "
        Return ONLY valid JSON.
        Do NOT include markdown, text, or explanation.

        Keys:
        annual_rainfall,
        humidity,
        monsoon_tolerance,
        soil_moisture,
        drainage,
        drought_tolerance,
        light,
        soil_type,
        fertilizing_schedule,
        repotting_frequency,
        support_needed,
        common_mistakes,
        preferred_soil_type,
        soil_ph_range,
        texture_requirement,
        organic_matter_need,
        ground_soil_preparation,
        nutrient_preference,
        watering_frequency,
        water_amount,
        season_watering,
        soil_check_method,
        common_pests,
        signs_of_infestation,
        organic_control_methods,
        chemical_control,
        spray_intervals,
        preventive_measures,
        soil_borne_disease_signs,
        ideal_temperature,
        min_temperature,
        max_temperature,
        season_preference,
        indoor_outdoor_suitability,
        frost_tolerance, 
        heat_tolerance,
        lifecycle,
        growth_rate,
        mature_size,
        flowering_fruiting_season,
        'growing_season',
        ideal_environment.

        Plant: $plantName
        ";

                $response = Http::post(
            "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=" . env('GEMINI_API_KEY'),
            [
                "contents" => [
                    [
                        "parts" => [
                            ["text" => $prompt]
                        ]
                    ]
                ]
            ]
        );

        // ✅ SAFE RESPONSE CHECK
        $text = $response->json()['candidates'][0]['content']['parts'][0]['text'] ?? null;

        if (!$text) {
            dd($response->json()); // 👈 shows real API error if any
        }

        $cleanJson = str_replace(['```json', '```'], '', $text);

        $plantData = json_decode(trim($cleanJson), true);//This line converts a JSON object into a native PHP associative array

        if (!$plantData) {
            dd([
                'raw' => $text,
                'json_error' => json_last_error_msg()
            ]);
        }
    
        return $plantData ?? null; 
    } 

    /**
     * Save the dynamic parameters into the 'details' database table
     */
    public function store($plantId, $plantData)
    {
        if (is_string($plantData)) {
            $plantData = json_decode($plantData, true);
        }

        /*
        |--------------------------------------------------------------------------
        | Validation Matrix - Ensures all incoming fields from the API are caught
        |--------------------------------------------------------------------------
        */
        $validated = validator($plantData, [
            // Fields used by your custom analytical numerical parsers
            'annual_rainfall'            => 'nullable|string',
            'ideal_temperature'          => 'nullable|string',
            'min_temperature'            => 'nullable|string',
            'max_temperature'            => 'nullable|string',
            
            // Textual parameters expected by your component designs
            'humidity'                   => 'nullable|string',
            'monsoon_tolerance'          => 'nullable|string',
            'soil_moisture'              => 'nullable|string',
            'drainage'                   => 'nullable|string',
            'drought_tolerance'          => 'nullable|string',
            'light'                      => 'nullable|string',
            'soil_type'                  => 'nullable|string',
            'fertilizing_schedule'       => 'nullable|string',
            'repotting_frequency'        => 'nullable|string',
            'support_needed'             => 'nullable|string',
            'common_mistakes'            => 'nullable|string',
            'preferred_soil_type'        => 'nullable|string',
            'soil_ph_range'              => 'nullable|string',
            'texture_requirement'        => 'nullable|string',
            'organic_matter_need'        => 'nullable|string',
            'ground_soil_preparation'    => 'nullable|string',
            'nutrient_preference'        => 'nullable|string',
            'watering_frequency'         => 'nullable|string',
            'water_amount'               => 'nullable|string',
            'season_watering'            => 'nullable|string',
            'soil_check_method'          => 'nullable|string',
            'common_pests'               => 'nullable|string',
            'signs_of_infestation'       => 'nullable|string',
            'organic_control_methods'    => 'nullable|string',
            'chemical_control'           => 'nullable|string',
            'spray_intervals'            => 'nullable|string',
            'preventive_measures'        => 'nullable|string',
            'soil_borne_disease_signs'   => 'nullable|string',
            'season_preference'          => 'nullable|string',
            'indoor_outdoor_suitability' => 'nullable|string',
            'frost_tolerance'            => 'nullable|string',
            'heat_tolerance'             => 'nullable|string',
            'lifecycle'                  => 'nullable|string',
            'growth_rate'                => 'nullable|string',
            'mature_size'                => 'nullable|string',
            'flowering_fruiting_season'  => 'nullable|string',
            'growing_season'             => 'nullable|string',
            'ideal_environment'          => 'nullable|string',
        ])->validate();

        /*
        |--------------------------------------------------------------------------
        | Run Custom Parsers for your Numerical Tracking metrics
        |--------------------------------------------------------------------------
        */
        $rainfall  = PlantDataParser::extractRainfallMm($validated['annual_rainfall'] ?? null);
        $idealTemp = PlantDataParser::extractCelsiusRange($validated['ideal_temperature'] ?? null);
        $minTemp   = PlantDataParser::extractSingleCelsius($validated['min_temperature'] ?? null);
        $maxTemp   = PlantDataParser::extractSingleCelsius($validated['max_temperature'] ?? null);
        /*
        |--------------------------------------------------------------------------
        | Database Save (Using updateOrCreate for 1-1 data layer stability)
        |--------------------------------------------------------------------------
        */
        return Detail::updateOrCreate(
            ['plant_id' => $plantId],
            [
                // Original Raw Text fields
                'annual_rainfall'            => $validated['annual_rainfall'] ?? null,
                'ideal_temperature'          => $validated['ideal_temperature'] ?? null,
                'min_temperature'            => $validated['min_temperature'] ?? null,
                'max_temperature'            => $validated['max_temperature'] ?? null,

                // Calculated values for progress bars and scales
                'annual_rainfall_min_mm'     => $rainfall['min'] ?? null,
                'annual_rainfall_max_mm'     => $rainfall['max'] ?? null,
                'ideal_temp_min_c'           => $idealTemp['min'] ?? null,
                'ideal_temp_max_c'           => $idealTemp['max'] ?? null,
                'min_temp_c'                 => $minTemp,
                'max_temp_c'                 => $maxTemp,

                // Component Structural properties mappings
                'humidity'                   => $validated['humidity'] ?? null,
                'monsoon_tolerance'          => $validated['monsoon_tolerance'] ?? null,
                'soil_moisture'              => $validated['soil_moisture'] ?? null,
                'drainage'                   => $validated['drainage'] ?? null,
                'drought_tolerance'          => $validated['drought_tolerance'] ?? null,
                'light'                      => $validated['light'] ?? null,
                'soil_type'                  => $validated['soil_type'] ?? null,
                'fertilizing_schedule'       => $validated['fertilizing_schedule'] ?? null,
                'repotting_frequency'        => $validated['repotting_frequency'] ?? null,
                'support_needed'             => $validated['support_needed'] ?? null,
                'common_mistakes'            => $validated['common_mistakes'] ?? null,
                'preferred_soil_type'        => $validated['preferred_soil_type'] ?? null,
                'soil_ph_range'              => $validated['soil_ph_range'] ?? null,
                'texture_requirement'        => $validated['texture_requirement'] ?? null,
                'organic_matter_need'        => $validated['organic_matter_need'] ?? null,
                'ground_soil_preparation'    => $validated['ground_soil_preparation'] ?? null,
                'nutrient_preference'        => $validated['nutrient_preference'] ?? null,
                'watering_frequency'         => $validated['watering_frequency'] ?? null,
                'water_amount'               => $validated['water_amount'] ?? null,
                'season_watering'            => $validated['season_watering'] ?? null,
                'soil_check_method'          => $validated['soil_check_method'] ?? null,
                'common_pests'               => $validated['common_pests'] ?? null,
                'signs_of_infestation'       => $validated['signs_of_infestation'] ?? null,
                'organic_control_methods'    => $validated['organic_control_methods'] ?? null,
                'chemical_control'           => $validated['chemical_control'] ?? null,
                'spray_intervals'            => $validated['spray_intervals'] ?? null,
                'preventive_measures'        => $validated['preventive_measures'] ?? null,
                'soil_borne_disease_signs'   => $validated['soil_borne_disease_signs'] ?? null,
                'season_preference'          => $validated['season_preference'] ?? null,
                'indoor_outdoor_suitability' => $validated['indoor_outdoor_suitability'] ?? null,
                'frost_tolerance'            => $validated['frost_tolerance'] ?? null,
                'heat_tolerance'             => $validated['heat_tolerance'] ?? null,
                'lifecycle'                  => $validated['lifecycle'] ?? null,
                'growth_rate'                => $validated['growth_rate'] ?? null,
                'mature_size'                => $validated['mature_size'] ?? null,
                'flowering_fruiting_season'  => $validated['flowering_fruiting_season'] ?? null,
                'growing_season'             => $validated['growing_season'] ?? null,
                'ideal_environment'          => $validated['ideal_environment'] ?? null,
            ]
        );
    }
}