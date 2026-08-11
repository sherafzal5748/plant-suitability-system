<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function register(Request $request)
    {
        // 1. Validate incoming data against rules matching your form names 
        $validatedData = $request->validate([
            'first_name'            => 'required|string|max:255',
            'last_name'             => 'required|string|max:255',
            'role'                  => 'required|in:farmer,enthusiast',
            'email'                 => 'required|string|email|max:255|unique:users',
            'phone'                 => 'nullable|string|max:20',
            'password'              => 'required|string|min:6|max:12|confirmed', // looks for password_confirmation
            'country'               => 'required|string|max:30',
            'state'                 => 'required|string|max:255',
            'city'                  => 'required|string|max:255',
            'street_address'        => 'required|string|max:255',
            'terms'                 => 'required|accepted',
        ]);

        // 2. Create the user in the database
        $user = User::create([
            'first_name'     => $validatedData['first_name'],
            'last_name'      => $validatedData['last_name'],
            'role'           => $validatedData['role'],
            'email'          => $validatedData['email'],
            'phone'          => $validatedData['phone'],
            'password'       => Hash::make($validatedData['password']), // Securely encrypt password
            'country'        => $validatedData['country'],
            'state'          => $validatedData['state'],
            'city'           => $validatedData['city'],
            'street_address' => $validatedData['street_address'],
        ]);

        // Explicitly write session changes to storage before leaving the request cycle
        session()->flash('success', 'Enrollment complete! Please log in with your credentials.');
        session()->save();

        return redirect()->route('login');
    }

    public function showRegistrationForm()
    {
        return view('auth.registration');
    }
}
