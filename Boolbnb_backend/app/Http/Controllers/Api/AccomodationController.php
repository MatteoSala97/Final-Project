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
        $min_price = $request->query('min_price') ?? 0;
        $max_price = $request->query('max_price');
        $type = $request->query('type');
        $max_distance = $request->query('max_distance');
        $point_lat = $request->query('lat');
        $point_lng = $request->query('lng');

        $accomodations_query = Accomodation::query();

        // Max_distance filter
        if ($max_distance !== null && $point_lat !== null && $point_lng !== null) {
            $accomodations_query->selectRaw("*")
                ->selectRaw("ST_Distance_Sphere(POINT(longitude, latitude), POINT(?, ?)) AS distance", [$point_lng, $point_lat])
                ->having('distance', '<=', $max_distance * 1000);
        }

        // Additional filters
        if ($max_price !== null) {
            $accomodations_query->whereBetween('price_per_night', [$min_price, $max_price]);
        }

        if ($type !== null) {
            $accomodations_query->where('type', $type);
        }

        // Order by distance if latitude and longitude are provided
        if ($point_lat !== null && $point_lng !== null) {
            $accomodations_query->orderByRaw('ST_Distance_Sphere(POINT(longitude, latitude), POINT(?, ?))', [$point_lng, $point_lat]);
        }

        // Eager loading relationships
        $accomodations_query->with(['pictures', 'services']);


        $accomodations = $accomodations_query->paginate(15);
        //if max_distance was among the filters, attach a "distance_from_point" additional info
        if ($max_distance !== null) {
            foreach ($accomodations as $accommodation) {
                // Calculate the distance for each accommodation
                $distance = $accommodation->distanceToPoint($point_lng, $point_lat);
                $accommodation->distance_from_point = $distance;
            }
        }



        if ($accomodations->total() > 0) {
            return response()->json([
                'success' => true,
                'res' => $accomodations
            ]);
        } else {
            return response()->json([
                'success' => false,
                'res' => [],
                'error' => 'No accommodations found.'
            ]);
        }
    }
}
