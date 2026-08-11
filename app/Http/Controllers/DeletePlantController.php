<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use Illuminate\Http\Request;

class DeletePlantController extends Controller
{
    /**
     * Show the delete-a-plant page (or return AJAX JSON).
     */
    public function index(Request $request)
    {
        $query = Plant::query();

        if ($search = $request->input('search')) {
            $query->where('plant_name', 'like', '%' . $search . '%');
        }
        if ($category = $request->input('category')) {
            $query->where('category', $category);
        }
        if ($season = $request->input('growing_season')) {
            $query->where('growing_season', $season);
        }

        $plants = $query->orderBy('plant_name')->paginate(10)->withQueryString();

        if ($request->ajax()) {
            return response()->json([
                'total'    => $plants->total(),
                'showing'  => $plants->count(),
                'from'     => $plants->firstItem() ?? 0,
                'to'       => $plants->lastItem()   ?? 0,
                'prevPage' => $plants->currentPage() > 1 ? $plants->currentPage() - 1 : null,
                'nextPage' => $plants->hasMorePages() ? $plants->currentPage() + 1 : null,
                'rows'     => $plants->map(fn($p) => [
                    'id'             => $p->id,
                    'plant_name'     => $p->plant_name,
                    'scientific_name'=> $p->scientific_name,
                    'category'       => $p->category,
                    'growing_season' => $p->growing_season,
                    'suitability'    => $p->suitability,
                    'image'          => $p->image,
                ]),
            ]);
        }

        return view('plants.delete', compact('plants'));
    }

    /**
     * Hard-delete a plant.
     */
    public function destroy(Request $request, Plant $plant)
    {
        $name      = $plant->plant_name;
        $imagePath = $imagePath = public_path('assets/images/home_plants/' . $plant->image);

        if ($plant->image && file_exists($imagePath)) {
            unlink($imagePath);
        }

        $plant->delete();

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => "'{$name}' has been deleted."]);
        }

        return redirect()->route('plant_catalog')
                         ->with('success', "'{$name}' has been permanently deleted.");
    }
}