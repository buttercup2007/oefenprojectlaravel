<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Chirp;
class ChirpController extends Controller
{
public function index()
{
    $chirps = Chirp::latest()->get();

    return view('home', compact('chirps'));
}
}

{
return view('home');
}





