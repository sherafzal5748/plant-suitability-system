<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plant;

class PlantController extends Controller
{
    public function index(Request $request)
    {
        $query = Plant::query();

        /*
        |--------------------------------------------------------------------------
        | Category Filter
        |--------------------------------------------------------------------------
        */
        if ($request->filled('category') && $request->category !== 'All Plants') {
            $query->where('category', $request->category);
        }

        /*
        |--------------------------------------------------------------------------
        | Growth Period Filter
        | DB stores growth_period as a plain number e.g. "14"
        |--------------------------------------------------------------------------
        */
        if ($request->filled('growth_period') && $request->growth_period !== 'Any Duration') {
            switch ($request->growth_period) {
                case '3 months':
                    $query->whereBetween('growth_period', [1, 3]);
                    break;
                case '6 months':
                    $query->whereBetween('growth_period', [4, 6]);
                    break;
                case '12 months':
                    $query->whereBetween('growth_period', [7, 12]);
                    break;
                case '12+ months':
                    $query->where('growth_period', '>', 12);
                    break;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Suitability Filter
        | DB stores lowercase: 'high', 'moderate', 'low'
        | Form sends: 'High', 'Moderate', 'Low', 'All'
        |--------------------------------------------------------------------------
        */
        if ($request->filled('suitability') && $request->suitability !== 'All') {
            $query->whereRaw('LOWER(suitability) = ?', [strtolower($request->suitability)]);
        }

        /*
        |--------------------------------------------------------------------------
        | Growing Season Filter
        | Supports array (season[]) from checkboxes
        |--------------------------------------------------------------------------
        */
        if ($request->filled('season')) {
            $seasons = is_array($request->season) ? $request->season : [$request->season];
            $query->where(function ($q) use ($seasons) {
                foreach ($seasons as $season) {
                    $q->orWhereRaw('LOWER(growing_season) = ?', [strtolower($season)]);
                }
            });
        }

        /*
        |--------------------------------------------------------------------------
        | Sunlight Filter
        |--------------------------------------------------------------------------
        */
        if ($request->filled('sunlight')) {
            $query->whereRaw('LOWER(sunlight_requirement) = ?', [strtolower($request->sunlight)]);
        }

        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('plant_name', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('scientific_name', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('category', 'LIKE', '%' . $request->search . '%');
            });
        }

        $plants = $query->paginate(8)->withQueryString();

        return view('frontend.home', compact('plants'));
    }
}