<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plant;

class PlantSearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->get('query');
        
        if (strlen($query) < 2) {
            return response()->json([]);
        }

        $plants = Plant::where('plant_name', 'like', "%{$query}%")
            ->orWhere('scientific_name', 'like', "%{$query}%")
            ->take(5)
            ->get();

        return response()->json($plants);
    }
}