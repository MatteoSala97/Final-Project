<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Accomodation;
use Illuminate\Http\Request;

class AccomodationController extends Controller
{
    public function index(Request $request)
    {

        $min_price = $request->query('min_price');
        $max_price = $request->query('max_price');

        $query = Accomodation::query()->with('services', 'pictures');

        if($min_price!== null){
            $query->where('price_per_night', '>=', $min_price);
        } if($max_price!== null){
            $query->where('price_per_night', '<=', $max_price);
        }

        $accomodations = $query->paginate(15);

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

