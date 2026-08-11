<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileDetailController extends Controller
{
    /**
     * Handle the async profile avatar upload.
     */
    public function updateAvatar(Request $request)
    {
        // 1. Tight Validation Security Check
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // max 2MB
        ]);

        // 2. Explicitly find the user via the Eloquent Model
        $user = User::find(Auth::id());

        if (!$user) {
            return response()->json(['error' => 'User not found or unauthenticated.'], 401);
        }

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');

            // 3. Generate clean, unique filename using user ID
            $filename = 'avatar_user' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();

            // 4. Store file directly into storage/app/public/avatars folder
            $path = $file->storeAs('avatars', $filename, 'public');

            // 5. Clean up old image using your correct column name ('image')
            if ($user->image && Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }

            // 6. Update Eloquent model using your exact database column name!
            $user->image = 'avatars/' . $filename;
            $user->save(); 

            return response()->json([
                'success' => true,
                'message' => 'Profile picture successfully saved!',
                'path'    => asset('storage/' . $user->image)
            ], 200);
        }

        return response()->json(['error' => 'File upload processing failed.'], 400);
    }
}