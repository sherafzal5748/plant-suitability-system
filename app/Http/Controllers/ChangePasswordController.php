<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ChangePasswordController extends Controller
{
    /**
     * Show the change password view.
     */
    public function edit()
    {
        return view('auth.change-password');
    }

    /**
     * Handle updating the password.
     */
    public function update(Request $request)
    {
        // Enforce validations exactly match instructions on your UI sub-copy
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => [
                'required', 
                'confirmed', 
                Password::min(6) // At least 6 characters
                    ->max(12)
                    ->letters()  
                    ->mixedCase() // Capital letters
                    ->numbers()   // Digits
                    ->symbols()   // Special characters
            ],
        ]);

        // Securely update the model password using structural model injection via auth helper
        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('password_changed_succuessfully');
    }
}
