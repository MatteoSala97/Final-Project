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
        $type = $request->query('type');

        $query = Accomodation::query();



        if ($min_price !== null && $max_price !== null) {
            $query->whereBetween('price_per_night', [$min_price, $max_price]);
        }

        if ($type !== null) {
            $query->where('type', $type);
        }


        $accomodations = $query->paginate(15);
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

