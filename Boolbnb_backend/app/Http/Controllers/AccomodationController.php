<?php

namespace App\Http\Controllers;

use App\Models\Accomodation;
use App\Models\Service;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;

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
        $services = Service::all();
        return view('pages.accomodation.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $client = new Client([
            'verify' => false, // Disable SSL verification
        ]);

        // dd($request->all());

        //did this cause checkbox doenst return a boolean
        // $request['hidden'] = $request->has('hidden');


        //removed thumb but add it back
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|min:1',
            'rooms' => 'required|integer|min:1',
            'beds' => 'required|integer|min:1',
            'bathrooms' => 'required|integer|min:1',
            'address' => 'required|string',
            'city' => 'required|string',
            'price_per_night' => 'required|numeric',
            // 'hidden' => 'boolean',
            //image validation
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'

        ]);

            //handling IF the user has uploaded an image
            if($request->hasFile('image')){
                $imagePath = $request->file('image')->store('public/images');

                //this modifies the path in order to make it publicly accessible
                $imagePath = str_replace('public/', 'storage/', $imagePath);

                //saves the path into val data
                $validatedData['image'] = $imagePath;
            }

            //error handling
            try {
                $accomodation = Accomodation::create($validatedData);
                // Aggiungi qui eventuali altre operazioni dopo il salvataggio dei dati
            } catch (\Exception $e) {
                // Gestisci gli errori durante il salvataggio dei dati
                return back()->withInput()->withErrors(['error' => 'Errore durante il salvataggio dei dati']);
            }

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


        $validatedData['latitude'] = $latitude;
        $validatedData['longitude'] = $longitude;
        $validatedData['user_id'] = auth()->id();



        $new_accomodation = Accomodation::create($validatedData);

        if ($request->has('services') && is_array($request->services) && count($request->services) > 0) {
            foreach ($request->services as $serviceId) {
                if (Service::find($serviceId)) {
                    $new_accomodation->services()->attach($serviceId, ['created_at' => now(), 'updated_at' => now()]);
                }
            }
        }

        return redirect()->route('dashboard')->with('success');
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
        return view('pages.accomodation.edit', compact('accomodation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Accomodation $accomodation)
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
            // 'hidden' => 'boolean',
            'thumb' => 'required|string',
            'host_thumb' => 'required|string',
            'rating' => 'required|numeric',
            'user_id' => 'required|integer',
        ]);

        $accomodation->update($validatedData);

        $accomodation->update([
            'latitude' => $latitude,
            'longitude' => $longitude,
        ]);

        return redirect()->route('dashboard');
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
