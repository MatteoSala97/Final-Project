<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccomodationStoreRequest;
use App\Models\Accomodation;
use App\Models\Service;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class AccomodationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accomodations = Accomodation::where('user_id', auth()->id())->get();
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
    //Alex: I moved the validation logic in the form request
    public function store(AccomodationStoreRequest $request)
    {


        $client = new Client([
            'verify' => false, // Disable SSL verification
        ]);
        $response = $client->get('https://api.tomtom.com/search/2/search/' . urlencode($request->address . ' ' . $request->cap . ' ' . $request->city) . '.json', [
            'query' => [
                // Add your tomtom API key to the .env file else it won't work
                'key' => env('TOMTOM_API_KEY'),
                'countrySet' => 'IT',
            ],
        ]);

        $data = json_decode($response->getBody(), true);
        $latitude = $data['results'][0]['position']['lat'];
        $longitude = $data['results'][0]['position']['lon'];

        $validatedData = $request->validated();

        // lat and long are calculated with the api call and attached to the validated data
        $validatedData['latitude'] = $latitude;
        $validatedData['longitude'] = $longitude;
        $validatedData['user_id'] = auth()->id();
        //doing this to make sure the checkbox returns a boolean
        // $request['hidden'] = $request->has('hidden');

        $new_accommodation = Accomodation::create($validatedData);

        // Attach services if provided
        if ($request->has('services') && is_array($request->services) && count($request->services) > 0) {
            foreach ($request->services as $serviceId) {
                if (Service::find($serviceId)) {
                    $new_accommodation->services()->attach($serviceId, ['created_at' => now(), 'updated_at' => now()]);
                }
            }
        }

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
<<<<<<< HEAD
        return view('pages.accomodation.edit', compact('accomodation'));
=======
        $services = Service::all();

        return view('pages.accomodation.edit', compact('accomodation', 'services'));
>>>>>>> 3aaeda186202e815454b7b3a73cf68cf2186dd50
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

<<<<<<< HEAD
=======
        // $request['hidden'] = $request->has('hidden');

        //add thumb back
>>>>>>> 3aaeda186202e815454b7b3a73cf68cf2186dd50
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|min:1',
            'rooms' => 'required|integer|min:1',
<<<<<<< HEAD
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
=======
            'beds' => 'integer|min:1',
            'bathrooms' => 'integer|min:1',
            'address' => 'required|string',
            'city' => 'required|string',
            'price_per_night' => 'required|numeric',
>>>>>>> 3aaeda186202e815454b7b3a73cf68cf2186dd50
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
        $accomodation->services()->detach();

        $accomodation->delete();

        return redirect()->route('dashboard');
    }
}
