<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Accomodation;
use Illuminate\Http\Request;

class AccomodationController extends Controller
{
    public function index(Request $request)
    {


        /*QUERY SEARCH EXAMPLE (TESTING PURPOSES)

        http://127.0.0.1:8000/api/accommodations?min_price=100&max_price=200&type=apartment&beds=1&rooms=1&bathrooms=1

        It should give 43 results

        */

        //Get query parameters
        $min_price = $request->query('min_price');
        $max_price = $request->query('max_price');
        $type = $request->query('type');    //type of accommodation (house, guesthouse, apartment, etc.)
        $beds = $request->query('beds');    //number of beds
        $rooms = $request->query('rooms');  //number of rooms
        $bathrooms = $request->query('bathrooms');  //number of bathrooms


        //Start building the query to fetch accommodations
        $query = Accomodation::query();

        //Filter based on price range
        if ($min_price !== null && $max_price !== null) {
            $query->whereBetween('price_per_night', [$min_price, $max_price]);
        }

        //Filter based on type
        if ($type !== null) {
            $query->where('type', $type);
        }

        //Filter based on number of beds
        if($beds !==null){
            $query->where('beds', $beds);
        }

        //Filter based on number of rooms
        if($rooms !==null){
            $query->where('rooms', $rooms);
        }

        //Filter based on number of bathrooms
        if($bathrooms !==null){
            $query->where('bathrooms', $bathrooms);
        }

        //Paginate the results
        $accomodations = $query->with(['pictures', 'services'])->paginate(15);


        if ($accomodations->total() > 0) {
            return response()->json([
                'success' => true,
                'res' => $accomodations
            ]);
        } else {
            return response()->json([
                'success' => false,
                'res' => null,
                'error' => 'No accommodations found.'
            ]);
        }
    }
}

