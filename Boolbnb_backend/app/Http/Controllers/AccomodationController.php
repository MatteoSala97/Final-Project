<?php

namespace App\Http\Controllers;

use App\Models\Accomodation;
use Illuminate\Http\Request;

class AccomodationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accomodations = Accomodation::all();
        return view('pages.accomodation.index', compact('accomodations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.accomodation.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|min:1',
            'rooms' => 'required|integer|min:1',
            'beds' => 'required|integer|min:1',
            'bathrooms' => 'required|integer|min:1',
            'address' => 'required|string',
            'city' => 'required|string',
            'latitude' => 'required|string',
            'longitude' => 'required|string',
            'price_per_night' => 'required|numeric',
            'hidden' => 'required|boolean',
            'thumb' => 'required|string',
            'host_thumb' => 'required|string',
            'rating' => 'required|numeric',
            'user_id' => 'required|integer',
        ]);

        // dd($request);

        $new_accomodations = Accomodation::create($validatedData);
        return redirect()->route('dashboard');
    }


    /**
     * Display the specified resource.
     */
    public function show(Accomodation $accomodation)
    {
        // return view('pages.accomodation.show', compact('accomodations'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Accomodation $accomodation)
    {
        // return view('pages.accomodation.edit', compact('accomodations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Accomodation $accomodation)
    {
        // $val_data = $request->validated();

        // $accomodation->update($val_data);
        // return redirect()->route('dashboard.accomodation.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Accomodation $accomodation)
    {
        // $accomodations = Accomodation::all();

        // return redirect()->route('dashboard.accomodation.index');
    }
}
