<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\Request;

class ChirpController extends Controller
{

public function edit(Chirp $chirp)
{
    // We'll add authorization in lesson 11
    return view('chirps.edit', compact('chirp'));
}

public function update(Request $request, Chirp $chirp)
{
    // Authorization

    // Validate
    $validated = $request->validate([
        'message' => 'required|string|max:255',
    ]);

    // Update the chirp
    $chirp->update($validated);

    return redirect('/')->with('success', 'Chirp updated!');
}

public function destroy(Chirp $chirp)
{
    $chirp->delete();

    return redirect('/')->with('success', 'Chirp deleted!');
}
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
// Create the chirp (no user for now - we'll add auth later)
Chirp::create([
    'message' => $validated['message'],
    'user_id' => null, // We'll add authentication in lesson 11
]);

    // Redirect back to the feed
return redirect('/')->with('success', 'Chirp created!'); 
}}

