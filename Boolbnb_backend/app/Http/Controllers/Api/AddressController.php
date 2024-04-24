<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class AddressController extends Controller
{
    public function suggestAddressList(Request $request)
    {
        try {
            $client = new Client([
                'verify' => false, // Disable SSL verification (for debugging)
            ]);

            $address = $request->query('address');

            $response = $client->get('https://api.tomtom.com/search/2/search/' . urlencode($address) . '.json', [
                'query' => [
                    'key' => env('TOMTOM_API_KEY'),
                    'countrySet' => 'IT',
                ],
            ]);

            $data = json_decode($response->getBody(), true);

            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
