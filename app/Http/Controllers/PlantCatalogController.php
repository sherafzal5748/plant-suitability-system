<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PlantCatalogController extends Controller
{
    /**
     * Display the filtered and paginated catalog list.
     */
    public function index(Request $request)
    {
        // 1. Fetch distinct lists for filter panels
        $categories = Plant::select('category')->whereNotNull('category')->distinct()->pluck('category');
        $seasons = Plant::select('growing_season')->whereNotNull('growing_season')->distinct()->pluck('growing_season');

        // 2. Build contextual stats metrics
        $totalPlantsCount = Plant::count();
        $totalCategoriesCount = $categories->count();
        
        // Count highly suitable plants directly from the main plants table schema
        $highlySuitableCount = Plant::where('suitability', 'high')->count();

        // 3. Construct filtering query
        $query = Plant::query();

        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        if ($request->has('season') && $request->season != '') {
            $query->where('growing_season', $request->season);
        }

        // 4. Paginate maintaining active layout filters + Eager load detail relation
        $plants = $query->with('detail')->paginate(10)->withQueryString();

        return view('admin.plant_catalog', compact(
            'plants', 
            'categories', 
            'seasons', 
            'totalPlantsCount', 
            'totalCategoriesCount', 
            'highlySuitableCount'
        ));
    }

    public function editMatrix(Request $request)
    {
        // Fetch all database plant rows so your step 1 query vault lookup dropdown populates instantly
        $plants = Plant::orderBy('plant_name', 'asc')->get();

        return view('admin.update_a_plant', compact('plants'));
    }

    /**
     * Delete an individual record dynamically.
     */
    public function destroy($id)
    {
        $plant = Plant::findOrFail($id);
        $plant->delete();

        return redirect()->route('plant_catalog')->with('success', 'Plant deleted successfully.');
    }

    /**
     * Stream database records directly into CSV formatted output downloads.
     */
    public function exportCsv(Request $request)
    {
        $query = Plant::query();

        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        if ($request->has('season') && $request->season != '') {
            $query->where('growing_season', $request->season);
        }

        $plants = $query->get();

        $response = new StreamedResponse(function () use ($plants) {
            $handle = fopen('php://output', 'w');
            
            // CSV Header Row
            fputcsv($handle, ['ID', 'Plant Name', 'Plant Code', 'Category', 'Growing Season', 'Suitability Status']);

            foreach ($plants as $plant) {
                fputcsv($handle, [
                    $plant->id,
                    $plant->name,
                    $plant->plant_code ?? ('SS-' . (1000 + $plant->id) . '-X'),
                    $plant->category,
                    $plant->growing_season,
                    $plant->suitability ?? 'Monitoring',
                ]);
            }

            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="suitable_sow_catalog_export.csv"',
        ]);

        return $response;
    }
}