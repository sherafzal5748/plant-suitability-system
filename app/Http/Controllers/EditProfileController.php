<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EditProfileController extends Controller
{
    public function update(Request $request)
    {
        // Using $request->user() instantly resolves the "undefined method update" IDE warning
        $user = $request->user();

        // Validate strictly according to your database schema columns
        $validated = $request->validate([
            'first_name'     => 'required|string|max:255',
            'last_name'      => 'required|string|max:255', // Made required to match your schema
            'email'          => 'required|email|unique:users,email,' . $user->id,
            'role'           => 'required|in:farmer,enthusiast,admin',
            'country'        => 'nullable|string|max:255',
            'state'          => 'nullable|string|max:255',
            'city'           => 'nullable|string|max:255',
            'street_address' => 'nullable|string|max:255', // Renamed from 'address' to match schema
            'phone'          => 'nullable|string|max:255',
            'image'          => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', 
        ]);

        // Handle Profile Image Upload if provided
        if ($request->hasFile('image')) {
            if (!empty($user->image) && Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }

            // Store the new uploaded file inside storage/app/public/avatars
            $path = $request->file('image')->store('avatars', 'public');
            $validated['image'] = $path;
        }

        // Persist all changes down to the database row
        $user->update($validated);

        return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }
}