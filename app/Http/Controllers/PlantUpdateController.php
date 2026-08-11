<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PlantUpdateController extends Controller
{
    /**
     * Load the lookup engine with all existing plant data records.
     */
    public function edit()
    {
        // Fetch all elements to allow JavaScript to handle interactive filtering safely
        $plants = DB::table('plants')->get();
        
        return view('admin.update_a_plant', compact('plants'));
    }

    /**
     * Persist structural changes to the database.
     */
    public function update(Request $request, $id)
    {
        // 1. Verify existence of target database row
        $plant = DB::table('plants')->where('id', $id)->first();
        if (!$plant) {
            return redirect()->back()->withErrors(['error' => 'The selected plant asset tracking signature was invalid.']);
        }

        // 2. Enforce strict input validation criteria
        $validated = $request->validate([
            'plant_name'           => 'required|string|max:255',
            'scientific_name'      => 'required|string|max:255',
            'category'             => 'required|in:Fruit,Crops,Vegetables,Evergreen',
            'image'                => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'suitability'          => 'nullable|in:low,medium,high',
            'growth_period'        => 'nullable|string|max:255',
            'growing_season'       => 'nullable|in:spring,summer,autumn,winter',
            'sunlight_requirement' => 'nullable|in:Full Sun,Partial Shade',
        ]);

        $imageName = $plant->image; // Fallback to current asset descriptor string

        // 3. Handle File Upload & Storage Management
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            
            // Format unique runtime filename string
            $imageName = time() . '-' . preg_replace('/[^A-Za-z0-9\-.]/', '', $image->getClientOriginalName());
            $destinationPath = public_path('assets/images/home_plants');

            // Purge the obsolete physical asset to save disk space
            $oldImagePath = $destinationPath . '/' . $plant->image;
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }

            // Write asset to file system path
            $image->move($destinationPath, $imageName);
        }

        // 4. Update the record
        DB::table('plants')
            ->where('id', $id)
            ->update([
                'plant_name'           => $validated['plant_name'],
                'scientific_name'      => $validated['scientific_name'],
                'category'             => $validated['category'],
                'image'                => $imageName,
                'suitability'          => $validated['suitability'] ?? null,
                'growth_period'        => $validated['growth_period'] ?? null,
                'growing_season'       => $validated['growing_season'] ?? null,
                'sunlight_requirement' => $validated['sunlight_requirement'] ?? null,
            ]);

        return redirect()->route('update_a_plant')->with('success', 'Botanical parameters optimized and saved successfully!');
    }
}