<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Whitelist;
use Illuminate\Support\Facades\Auth;

class whitelistController extends Controller
{
    // 1. View all whitelisted items
    public function index()
{
    // 1. Fetch the items for the logged-in user
    $whitelists = Auth::user()->whitelists; 

    // 2. Return the exact view file shown in your error trace, passing the variable along
    return view('frontend.whitelist', compact('whitelists'));
}

    // 2. Add an item to the whitelist
    public function store(Request $request)
    {
        $validated = $request->validate([
            'plant_id'        => 'required|string',
            'plant_name'      => 'required|string|max:255',
            'scientific_name' => 'nullable|string|max:255',
            'category'        => 'nullable|string|max:255',
            'image'           => 'nullable|string|max:255',
        ]);

        $userId = Auth::id();

        // Prevent duplicate entries of the SAME plant for this user
        $exists = Whitelist::where('user_id', $userId)
                           ->where('plant_id', $validated['plant_id'])
                           ->exists();

        if ($exists) {
            return redirect()->back()->with('info', 'This plant is already in your crops!');
        }

        // Create a new entry
        Whitelist::create([
            'user_id'         => $userId,
            'plant_id'        => $validated['plant_id'],
            'plant_name'      => $validated['plant_name'],
            'scientific_name' => $validated['scientific_name'],
            'category'        => $validated['category'],
            'image'           => $validated['image'],
        ]);

        return redirect()->back()->with('success', 'Plant added to your crops successfully!');
    }

    // 3. Clear an item from the whitelist
    public function destroy($id)
    {
        $whitelistItem = Whitelist::where('id', $id)->where('user_id', Auth::id())->first();

        if ($whitelistItem) {
            $whitelistItem->delete();
        }

        return redirect()->back()->with('success', 'Plant removed successfully!');
    }
}