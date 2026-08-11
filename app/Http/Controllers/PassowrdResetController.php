<?php

namespace App\Http\Controllers;

use App\Models\User; // 1. Include the User Model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // 2. Include Hash
use Illuminate\Validation\Rules\Password; // 3. Include Password Validation Rule

// Fixed typo in class name to match your routes
class PassowrdResetController extends Controller
{
    public function resetPassword(Request $request)
    {
        // 1. Clear any default value placeholders out of the validation if necessary
        // Note: Your Blade template has value="••••••••" hardcoded. Ensure users clear that out.
        
        // 2. Enforce your validation rules
        $validated = $request->validate([
            'password' => [
                'required', 
                'confirmed', 
                Password::min(6)
                    ->max(12)
                    ->letters()  
                    ->numbers() // Matches your UI sub-copy guide text
            ],
        ]);

        // 3. Retrieve the correct session email key from Step 1
        $userEmail = session('user_email');

        // Safety check if session expired or missing
        if (!$userEmail) {
            return redirect()->route('forgot_password')->withErrors(['email' => 'Session expired. Please restart the process.']);
        }

        // 4. Locate the user via the DB and update their password record
        $user = User::where('email', $userEmail)->first(); //DB: access method for non-loggedin users.(because at this stage when user has forgot his password, he is not logged in)

        if ($user) {
            $user->update([
                'password' => Hash::make($validated['password']),
            ]);

            // 5. Clean up the session so these values can't be reused maliciously
            session()->forget(['user_email', 'verification_code']);

            // 6. Redirect to success route
            return redirect()->route('Password_reset_successfully');
        }

        return redirect()->route('forgot_password')->withErrors(['email' => 'User not found.']);
    }
}