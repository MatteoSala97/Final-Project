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
        $max_price = $request->query('min_price');

        $accomodations = Accomodation::paginate(15);
        if ($accomodations->count() > 0) {
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
