<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
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
            ->get()
            # to format the date in a readable format
            ->map(function($chirp) {
                $chirp->prettyDate = $chirp->created_at
                    ->locale('en')
                    ->diffForHumans();
                    
                return $chirp;
            });
        // Use inertia every time to call a vue view
        // return view -> look for blade instead
        return Inertia::render('Home', [
            // Passing the array with the data
            'chirps' => $chirps
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'text' => 'required|string|max:255|min:5',
        ]);

        
        Chirp::create([
            'text' => $validated['text'],
        ]);

        return redirect('/')->with('success', 'Chirp created!');
    }

    public function edit(Chirp $chirp)
    {
        // Gate::authorize('edit', $chirp);

        return Inertia::render('Chirps/Edit', [
            'chirp' => $chirp,
        ]);
    }

    public function update(Request $request, Chirp $chirp)
    {
        $validated = $request->validate([
            'text' => 'required|string|max:255|min:5',
        ]);

        // Gate::authorize('update', $chirp);

        $chirp->update($validated);

        return redirect('/')->with('success', 'Your chirp has been updated!');
    }

    public function destroy(Chirp $chirp)
    {
        
        Gate::authorize('delete', $chirp);

        $chirp->delete();

        return redirect('/')->with('success', 'Your chirp has been deleted!');
    }



}
