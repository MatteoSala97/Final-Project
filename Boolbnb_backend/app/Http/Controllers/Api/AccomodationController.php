<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Accomodation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccomodationController extends Controller
{
    public function index(Request $request)
    {
        $min_price = $request->query('min_price');
        $max_price = $request->query('max_price');
        $type = $request->query('type');
        $max_distance = $request->query('max_distance');
        $point_lat = $request->query('lat');
        $point_lng = $request->query('lng');

        $accomodations_query = Accomodation::query();

        // Max_distance filter
        if ($max_distance !== null && $point_lat !== null && $point_lng !== null) {
            $accomodations_query->selectRaw("*")
                ->selectRaw("ST_Distance(point, POINT(?, ?)) AS distance", [$point_lng, $point_lat])
                ->having('distance', '<=', $max_distance * 1000);
        }

        // Additional filters
        if ($min_price !== null && $max_price !== null) {
            $accomodations_query->whereBetween('price_per_night', [$min_price, $max_price]);
        }

        if ($type !== null) {
            $accomodations_query->where('type', $type);
        }

        // Eager loading relationships
        $accomodations_query->with(['pictures', 'services']);


        $accomodations = $accomodations_query->paginate(15);

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
