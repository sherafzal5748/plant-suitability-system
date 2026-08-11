<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class AddPlantController extends Controller
{
   
    /**
     * Show the form for creating a new plant.
     */
    public function create()
    {
        return view('admin.add_a_plant');
    }

    /**
     * Store a newly created plant in storage.
     */
    public function store(Request $request)
    {
        // 1. Validate incoming request
        $validated = $request->validate([
            'plant_name'           => 'required|string|max:255',
            'scientific_name'      => 'required|string|max:255',
            'category'             => 'required|in:Fruit,Crops,Vegetables,Evergreen',
            'image'                => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'suitability'          => 'nullable|in:low,medium,high',
            'growth_period'        => 'nullable|string|max:255',
            'growing_season'       => 'nullable|in:spring,summer,autumn,winter',
            'sunlight_requirement' => 'nullable|in:Full Sun,Partial Shade',
        ]);

        // 2. Handle Image Upload to public/assets/images/home_plants/
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            
            // Create a clean, unique name (e.g., 1718923011-fig.png)
            $imageName = time() . '-' . preg_replace('/[^A-Za-z0-9\-.]/', '', $image->getClientOriginalName());
            
            // Define your target public path
            $destinationPath = public_path('assets/images/home_plants');
            
            // Move file to the destination
            $image->move($destinationPath, $imageName);
            
            // Save just the filename string into the database array
            $validated['image'] = $imageName;
        }

        // 3. Insert into database using Query Builder (or replace with your Model if available)
        DB::table('plants')->insert([
            'plant_name'           => $validated['plant_name'],
            'scientific_name'      => $validated['scientific_name'],
            'category'             => $validated['category'],
            'image'                => $validated['image'],
            'suitability'          => $validated['suitability'] ?? null,
            'growth_period'        => $validated['growth_period'] ?? null,
            'growing_season'       => $validated['growing_season'] ?? null,
            'sunlight_requirement' => $validated['sunlight_requirement'] ?? null,
        ]);

        // 4. Redirect with a fresh flash message
        return redirect()->route('add_a_plant')->with('success', 'Plant added beautifully to your botanical collection!');
    }

}
