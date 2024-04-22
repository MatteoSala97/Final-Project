<?php

namespace App\Http\Controllers;

use App\Models\Accomodation;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

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

        $client = new Client([
            'verify' => false, // Disable SSL verification
        ]);
        $response = $client->get('https://api.tomtom.com/search/2/search/' . urlencode($request->address . $request->city) . '.json', [
            'query' => [
                //add your tomtom_api_key to the .env else wont work
                'key' => env('TOMTOM_API_KEY'),
                'countrySet' => 'IT',
            ],
        ]);

        $data = json_decode($response->getBody(), true);
        $latitude = $data['results'][0]['position']['lat'];
        $longitude = $data['results'][0]['position']['lon'];




        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|min:1',
            'rooms' => 'required|integer|min:1',
            'beds' => 'required|integer|min:1',
            'bathrooms' => 'required|integer|min:1',
            'address' => 'required|string',
            'city' => 'required|string',
            'price_per_night' => 'required|numeric',
            'hidden' => 'required|boolean',
            'thumb' => 'required|string',
            'host_thumb' => 'required|string',
            'rating' => 'required|numeric',
            'user_id' => 'required|integer',
        ]);




        $validatedData['latitude'] = $latitude;
        $validatedData['longitude'] = $longitude;

        $new_accommodation = Accomodation::create($validatedData);



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
