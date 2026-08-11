<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class PlantSuitabilityController extends Controller
{
    public function show(Plant $plant)
    {
        $user = auth()->user();

        if (empty($user->city)) {
            return redirect()->back()->with(
                'error',
                'Please add your city in your profile to check local suitability.'
            );
        }

        $detail = $plant->detail; // may be null if no detail row exists

        /*
        ============================================
        STEP 1: GET COORDINATES (Open-Meteo Geocoding)
        ============================================
        */
        $geoData = Cache::remember(
            'geocode_' . strtolower($user->city),
            now()->addDays(30),
            function () use ($user) {
                return Http::get(
                    'https://geocoding-api.open-meteo.com/v1/search',
                    [
                        'name' => $user->city,
                        'count' => 5,
                        'language' => 'en',
                        'format' => 'json',
                    ]
                )->json();
            }
        );

        if (empty($geoData['results'])) {
            return redirect()->back()->with(
                'error',
                'We could not find climate data for your city. Please check your profile location.'
            );
        }

        // Prefer a result matching the user's stored country, else take the first match
        $match = collect($geoData['results'])->first(function ($result) use ($user) {
            return $user->country && isset($result['country'])
                && strtolower($result['country']) === strtolower($user->country);
        }) ?? $geoData['results'][0];

        $latitude   = $match['latitude'];
        $longitude  = $match['longitude'];
        $cityName   = $match['name'];
        $country    = $match['country'] ?? $user->country;

        /*
        ============================================
        STEP 2: FETCH HISTORICAL CLIMATE DATA
        ============================================
        */
        $climate = Cache::remember(
            'climate_' . round($latitude, 2) . '_' . round($longitude, 2),
            now()->addDays(7),
            function () use ($latitude, $longitude) {
                return Http::get(
                    'https://archive-api.open-meteo.com/v1/archive',
                    [
                        'latitude'   => $latitude,
                        'longitude'  => $longitude,
                        'start_date' => '2024-01-01',
                        'end_date'   => '2024-12-31',
                        'daily'      => implode(',', [
                            'temperature_2m_max',
                            'temperature_2m_min',
                            'temperature_2m_mean',
                            'precipitation_sum',
                        ]),
                        'timezone'   => 'auto',
                    ]
                )->json();
            }
        );

        if (empty($climate['daily'])) {
            return redirect()->back()->with(
                'error',
                'Climate data is temporarily unavailable. Please try again later.'
            );
        }

        $maxTemps  = $climate['daily']['temperature_2m_max'];
        $minTemps  = $climate['daily']['temperature_2m_min'];
        $meanTemps = $climate['daily']['temperature_2m_mean'];
        $rainfalls = $climate['daily']['precipitation_sum'];

        $yearlyMaxTemp   = max($maxTemps);
        $yearlyMinTemp   = min($minTemps);
        $idealTemperature = round(array_sum($meanTemps) / count($meanTemps), 1);
        $annualRainfall  = round(array_sum($rainfalls), 1);

        $frostDays = count(array_filter($minTemps, fn ($t) => $t <= 0));

        $localFrostRisk = $frostDays > 60 ? 'High' : ($frostDays > 20 ? 'Moderate' : 'Low');

        /*
        ============================================
        STEP 3: COMPARE AGAINST PLANT REQUIREMENTS
        ============================================
        */
        $tempMatch  = $this->matchLevel(
            $idealTemperature,
            $detail->ideal_temp_min_c ?? null,
            $detail->ideal_temp_max_c ?? null
        );

        $rainMatch  = $this->matchLevel(
            $annualRainfall,
            $detail->annual_rainfall_min_mm ?? null,
            $detail->annual_rainfall_max_mm ?? null
        );

        $frostMatch = $this->frostMatchLevel($localFrostRisk, $detail->frost_tolerance ?? null);

        $scoreMap = ['Good Match' => 100, 'Acceptable' => 60, 'Poor Match' => 20, 'Unknown' => 50];

        $overallScore = round(
            ($scoreMap[$tempMatch]  * 0.4) +
            ($scoreMap[$rainMatch]  * 0.4) +
            ($scoreMap[$frostMatch] * 0.2)
        );

        $status = $overallScore >= 80 ? 'Suitable' : ($overallScore >= 50 ? 'Acceptable' : 'Not Suitable');

        $matchMessage = match ($status) {
            'Suitable'   => 'This plant matches your location perfectly.',
            'Acceptable' => 'This plant can grow here with some care and adjustments.',
            default      => 'This plant is not well suited to your local climate.',
        };

        /*
        ============================================
        STEP 4: BAR WIDTHS FOR THE COMPARISON UI
        ============================================
        */
        $tempScaleMin = min($detail->min_temp_c ?? 0, $yearlyMinTemp) - 5;
        $tempScaleMax = max($detail->max_temp_c ?? 40, $yearlyMaxTemp) + 5;

        $tempReqWidth   = $this->percent($detail->ideal_temp_max_c ?? $detail->max_temp_c ?? 30, $tempScaleMin, $tempScaleMax);
        $tempLocalWidth = $this->percent($idealTemperature, $tempScaleMin, $tempScaleMax);

        $rainScaleMax = max($detail->annual_rainfall_max_mm ?? 1000, $annualRainfall) + 200;

        $rainReqWidth   = $this->percent($detail->annual_rainfall_max_mm ?? $rainScaleMax * 0.7, 0, $rainScaleMax);
        $rainLocalWidth = $this->percent($annualRainfall, 0, $rainScaleMax);

        return view('meteo_API.suitability', [
            'plant'          => $plant,
            'detail'         => $detail,
            'cityName'       => $cityName,
            'country'        => $country,
            'status'         => $status,
            'matchMessage'   => $matchMessage,
            'overallScore'   => $overallScore,

            'idealTemperature' => $idealTemperature,
            'annualRainfall'    => $annualRainfall,
            'localFrostRisk'    => $localFrostRisk,

            'tempMatch'  => $tempMatch,
            'rainMatch'  => $rainMatch,
            'frostMatch' => $frostMatch,

            'tempReqWidth'   => $tempReqWidth,
            'tempLocalWidth' => $tempLocalWidth,
            'rainReqWidth'   => $rainReqWidth,
            'rainLocalWidth' => $rainLocalWidth,
        ]);
    }

    /**
     * Compare a value against a plant's required range.
     * Allows a 15% tolerance buffer before marking it "Poor Match".
     */
    private function matchLevel($value, $min, $max, float $toleranceRatio = 0.15): string
    {
        if (is_null($min) || is_null($max)) {
            return 'Unknown';
        }

        if ($value >= $min && $value <= $max) {
            return 'Good Match';
        }

        $buffer = ($max - $min) * $toleranceRatio;

        if ($value >= ($min - $buffer) && $value <= ($max + $buffer)) {
            return 'Acceptable';
        }

        return 'Poor Match';
    }

    /**
     * Frost is compared by tolerance category rather than a numeric range.
     */
    private function frostMatchLevel(string $localRisk, ?string $plantTolerance): string
    {
        if (is_null($plantTolerance)) {
            return 'Unknown';
        }

        $order = ['Low' => 1, 'Moderate' => 2, 'High' => 3];

        $local = $order[$localRisk] ?? 1;
        $plant = $order[$plantTolerance] ?? 1;

        if ($plant >= $local) {
            return 'Good Match';
        }

        if ($plant === $local - 1) {
            return 'Acceptable';
        }

        return 'Poor Match';
    }

    private function percent($value, $min, $max): float
    {
        if ($max <= $min) {
            return 50;
        }

        $p = (($value - $min) / ($max - $min)) * 100;

        return max(0, min(100, round($p, 1)));
    }
}