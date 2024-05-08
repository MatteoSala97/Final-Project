<?php

namespace App\Http\Controllers;

use App\Http\Request\AccomodationStoreRequest;
use App\Http\Requests\AccomodationStoreRequest as RequestsAccomodationStoreRequest;
use App\Models\Accomodation;
use App\Models\Message;
use App\Models\Picture;
use App\Models\Service;
use App\Models\User;
use Braintree;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\Paginator;




class AccomodationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::findOrFail(auth()->id());
        $accomodations = Accomodation::where('user_id', auth()->id())->paginate(7);

        if ($accomodations === null) {
            $accomodations = [];
        }



        return view('dashboard', compact('accomodations', 'user'));
    }

    public function advertisement()
    {
        $accomodations = Accomodation::withCount('ads')
            ->where('user_id', auth()->id())
            ->orderBy('ads_count', 'desc')
            ->paginate(7);

        $gateway = new Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);

        $token = $gateway->clientToken()->generate();
        $tokenization_key = config('services.braintree.tokenizationKey');

        return view('pages.accomodation.advertisement', compact('accomodations', 'token', 'tokenization_key'));
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
    public function store(RequestsAccomodationStoreRequest $request)
    {

        $selected_address = json_decode($request['selected_address']);


        $validatedData = $request->validated();

        $uploadedFiles = $request->file('pictures');

        // if ($request->hasFile('pictures') && count($uploadedFiles) > 5) {
        //     return redirect()->back()->withErrors(['pictures' => 'You can upload a maximum of 5 pictures.']);
        // }

        unset($validatedData['pictures']);

        //image save


        // lat and long are calculated with the api call and attached to the validated data
        $validatedData['latitude'] = $selected_address->latitude;
        $validatedData['longitude'] = $selected_address->longitude;
        $validatedData['user_id'] = auth()->id();
        //doing this to make sure the checkbox returns a boolean
        $request['hidden'] = $request->has('hidden');

        $user = auth()->user();
        if ($user && $user->user_propic !== null) {

            $validatedData['host_thumb'] = $user->user_propic;
        }

        unset($validatedData['services']);

        $new_accommodation = Accomodation::create($validatedData);

        if ($request->hasFile('thumb')) {
            // Upload the image to the storage directory
            $img_path = Storage::put('uploads', $validatedData['thumb']);

            // Construct the full URL to the uploaded image
            $full_url = url('/') . '/storage/' . $img_path;

            // Save the full URL to the 'thumb' column in the 'Accomodation' model
            $validatedData['thumb'] = $full_url;

            // Update the 'thumb' column of the newly created 'Accomodation' record
            $new_accommodation->update(['thumb' => $full_url]);

            // Create a record in the 'picture' table
            $picture = Picture::create([
                'url' => $full_url,
                'accomodation_id' => $new_accommodation->id
            ]);
        }

        if ($request->hasFile('pictures')) {
            foreach ($request->file('pictures') as $image) {

                $img_path = Storage::put('uploads', $image);
                $full_url = url('/') . '/storage/' . $img_path;
                $picture = Picture::create([
                    'url' => $full_url,
                    'accomodation_id' => $new_accommodation->id
                ]);
            }
        }


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
     * Store a recently deleted resource in archive.
     */
    public function archive()
    {
        $accomodations = Accomodation::where('user_id', auth()->id())->onlyTrashed()->paginate(7);

        return view('pages.accomodation.archive', compact('accomodations'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Accomodation $accomodation)
    {
        return view('pages.accomodation.show', compact('accomodation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Accomodation $accomodation)
    {
        $services = Service::all();

        $associatedServices = $accomodation->services->pluck('id')->toArray();

        return view('pages.accomodation.edit', compact('accomodation', 'services', 'associatedServices'));
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



        // $request['hidden'] = $request->has('hidden');

        //add thumb back
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|min:1',
            'rooms' => 'required|integer|min:1',
            'beds' => 'integer|min:1',
            'bathrooms' => 'integer|min:1',
            'address' => 'required|string',
            'city' => 'required|string',
            'price_per_night' => 'required|numeric',
            'thumb' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'pictures.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',

        ]);

        if ($request->hasFile('pictures') && count($request->file('pictures')) > 5) {
            return redirect()->back()->withErrors(['pictures' => 'You can upload a maximum of 5 pictures.'])->withInput();
        }

        if ($request->hasFile('thumb')) {
            $img_path = Storage::put('uploads', $validatedData['thumb']);
            $validatedData['thumb'] = basename($img_path);
        }

        if ($request->hasFile('pictures')) {
            foreach ($request->file('pictures') as $image) {

                $img_path = Storage::put('uploads', $image);
                $full_url = url('/') . '/storage/' . $img_path;
                $picture = Picture::create([
                    'url' => $full_url,
                    'accomodation_id' => $accomodation->id
                ]);
            }
        }

        unset($validatedData['pictures']);

        $accomodation->update($validatedData);

        $accomodation->update([
            'latitude' => $latitude,
            'longitude' => $longitude,
        ]);


        if ($request->has('services')) {
            //sync does not support  updated and created at
            $accomodation->services()->sync($request->services);
        } else {

            $accomodation->services()->detach();
        }

        return redirect()->route('dashboard');
    }


    public function destroy(Accomodation $accomodation)
    {
        return view('pages.accomodation.delete_confirmation', compact('accomodation'));
    }

    public function deleteConfirmed(Accomodation $accomodation)
    {
        // dd($accomodation);

        $accomodation->services()->detach();

        $accomodation->delete();


        return redirect()->route('dashboard');
    }

    public function changeVisibility(Accomodation $accomodation)
    {
        $accomodation->update(['hidden' => !$accomodation->hidden]);
        return redirect()->route('dashboard');
    }


    public function restore(Accomodation $accomodation)
    {
        $accomodation->restore();

        return redirect()->to('dashboard');
    }

    public function showStats(Accomodation $accomodation)
    {
        return view('pages.accomodation.stat-graph', compact('accomodation'));
    }
}
