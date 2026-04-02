<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\Request;

class ChirpController extends Controller
{
    public function index()
    {
        $chirps = Chirp::with('user')
            ->latest()
            ->take(50)
            ->get();

        return view('home', ['chirps' => $chirps]);
    }

    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        // Create the chirp
        Chirp::create([
            'message' => $validated['message'],
            'user_id' => null, // later: auth()->id()
        ]);

        // Redirect back
        return redirect('/')->with('success', 'Chirp created!');
    }
}