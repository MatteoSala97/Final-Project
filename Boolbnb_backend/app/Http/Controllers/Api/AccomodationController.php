<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Accomodation;
use App\Models\User;
use Carbon\Carbon;
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
        $rooms = $request->query('rooms');
        $beds = $request->query('beds');
        $bathrooms = $request->query('bathrooms');


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

        if ($rooms !== null) {
            $accomodations_query->where('rooms', $rooms);
        }

        if ($beds !== null) {
            $accomodations_query->where('beds', $beds);
        }

        if ($bathrooms !== null) {
            $accomodations_query->where('bathrooms', $bathrooms);
        }

        // Order by distance if latitude and longitude are provided
        if ($point_lat !== null && $point_lng !== null) {
            $accomodations_query->orderByRaw('ST_Distance_Sphere(POINT(longitude, latitude), POINT(?, ?))', [$point_lng, $point_lat]);
        } else {
            // Filter by service ID 258
            // $accomodations_query->whereHas('services', function ($query) {
            //     $query->where('service_id', 25);
            // });
            $accomodations_query->orderBy('rating', 'desc');
        }

        //could be fix for markers
        // $accomodations = [];

        // if ($point_lat && $point_lng) {
        //     $accomodations = $accomodations_query->take(1000)->get();
        // } else {
        //     $accomodations = $accomodations_query->take(15)->get();
        // }

        // Eager loading relationships
        $accomodations_query->with(['pictures', 'services']);


        $accomodations = $accomodations_query->paginate(15);
        //if max_distance was among the filters, attach a "distance_from_point" additional info
        if ($max_distance !== null && $point_lat  !== null  && $point_lng  !== null) {
            foreach ($accomodations as $accommodation) {
                // Calculate the distance for each accommodation
                $distance = $accommodation->distanceToPoint($point_lng, $point_lat);
                $accommodation->distance_from_point = $distance;

        //attach host info


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

    public function show($id)
    {
        $accommodation = Accomodation::with(['pictures', 'services'])->find($id);

        $user = User::find($accommodation->user_id);


        if ($user) {
            $registeredDate = Carbon::parse($user->created_at)->format('d-m-Y');
            $accommodation->host_fullname = $user->name . ' ' . $user->surname;
            $accommodation->host_registration_date = $registeredDate;
        }



        if (!$accommodation) {
            return response()->json([
                'success' => false,
                'error' => 'Accommodation not found.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'res' => $accommodation
        ]);
    }
}
