<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chirp;
use Inertia\Inertia;


class ChirpController extends Controller
{
    //
    public function index()
    {   
        // Get the latest by desc order (ORM query)
        $chirps = Chirp::with('user')
            ->latest()
            ->take(10)
            ->get();
        // Use inertia every time to call a vue view
        // return view -> look for blade instead
        return Inertia::render('Home', [
            // Passing the array with the data
            'chirps' => $chirps
        ]);
    }
}
