<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Login extends Controller
{
    public function __invoke(Request $request)
    {
        // Validate the input
        $validated = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Attempt to log the user in
        if (Auth::attempt($validated)) {
            $request->session()->regenerate();

            return redirect('/')->with('success', 'Welcome back!');
        }

        // If login fails, redirect back with error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}