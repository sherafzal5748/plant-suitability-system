<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('auth.login'); // Adjust this path if your blade file is named differently
    }

    /**
     * Handle an authentication attempt.
     */
    public function login(Request $request)
    {
        // 1. Validate the incoming request data
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        // 2. Check the "Remember me" checkbox state
        $remember = $request->boolean('remember');

        // 3. Attempt to log the user in
        if (Auth::attempt($credentials, $remember)) {
            // Regenerate session to prevent session fixation attacks
            $request->session()->regenerate();

            // 4. Redirect based on the user's role from your schema
            return $this->authenticated($request, Auth::user());
        }

        // 5. If authentication fails, throw a validation exception (automatically returns back with old input)
        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);
    }

    /**
     * Handle post-authentication redirection based on schema roles.
     */
        protected function authenticated(Request $request, $user)
        {
            // Every authenticated user goes to the same unified home route
            return redirect()->intended(route('home'));
        }
    

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return view('frontend.logged_out');
    }
}



