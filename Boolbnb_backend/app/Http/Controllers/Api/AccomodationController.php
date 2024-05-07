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
        $services = $request->query('services');
        $order_by = $request->query('order_by');
        $max_distance_meters = $max_distance * 1000;



        $accomodations_query = Accomodation::where('hidden', false);


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
        if ($services !== null) {
            $accomodations_query->whereHas('services', function ($query) use ($services) {
                $query->whereIn('service_id', $services);
            });
        }

        // Order by distance if latitude and longitude are provided
        if ($point_lat !== null && $point_lng !== null) {
            $accomodations_query->leftJoin('accomodation_ad', 'accomodations.id', '=', 'accomodation_ad.accomodation_id')
                ->select('accomodations.*', 'accomodation_ad.accomodation_id AS has_ad')
                ->selectRaw('ST_Distance_Sphere(POINT(accomodations.longitude, accomodations.latitude), POINT(?, ?)) AS distance', [$point_lng, $point_lat])
                ->having('distance', '<=', $max_distance_meters);

            switch ($order_by) {
                case 'distance':
                    $accomodations_query->orderBy('distance');
                    break;
                case 'price':
                    $accomodations_query->orderBy('price_per_night');
                    break;
                case 'rating':
                    $accomodations_query->orderByDesc('rating');
                    break;
                default:
                    $accomodations_query->orderBy('distance');
                    break;
            }
        } else {
            // If latitude and longitude are not provided, order by default criteria
            $accomodations_query->leftJoin('accomodation_ad', 'accomodations.id', '=', 'accomodation_ad.accomodation_id')
                ->select('accomodations.*', 'accomodation_ad.accomodation_id AS has_ad')
                ->orderByRaw('has_ad DESC, accomodations.rating DESC');
        }





        $accomodations_query->orderBy('has_ad', 'DESC');

        // Eager loading relationships
        $accomodations_query->with(['pictures', 'services', 'ads']);







        $accomodations = $accomodations_query->paginate(15);




        foreach ($accomodations as $accommodation) {
            $accommodation->has_ad = $accommodation->ads->isNotEmpty();
        }
        //if max_distance was among the filters, attach a "distance_from_point" additional info
        if ($max_distance !== null && $point_lat  !== null  && $point_lng  !== null) {
            foreach ($accomodations as $accommodation) {
                // Calculate the distance for each accommodation
                $distance = $accommodation->distanceToPoint($point_lng, $point_lat);
                $accommodation->distance_from_point = $distance;
            }
        }

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

    public function filteredAccommodations(Request $request)
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
        $services = $request->query('services');

        $accommodations_query = Accomodation::where('hidden', false);




        if ($max_distance !== null && $point_lat !== null && $point_lng !== null) {
            $accommodations_query->selectRaw("*")
                ->selectRaw("ST_Distance_Sphere(POINT(longitude, latitude), POINT(?, ?)) AS distance", [$point_lng, $point_lat])
                ->having('distance', '<=', $max_distance * 1000);
        }

        // Apply filters
        if ($max_price !== null) {
            $accommodations_query->whereBetween('price_per_night', [$min_price, $max_price]);
        }

        if ($type !== null) {
            $accommodations_query->where('type', $type);
        }

        if ($rooms !== null) {
            $accommodations_query->where('rooms', $rooms);
        }

        if ($beds !== null) {
            $accommodations_query->where('beds', $beds);
        }

        if ($bathrooms !== null) {
            $accommodations_query->where('bathrooms', $bathrooms);
        }

        if ($services !== null) {
            // Check if services parameter is an array
            if (is_array($services)) {
                $accommodations_query->whereHas('services', function ($query) use ($services) {
                    $query->whereIn('service_id', $services);
                });
            } else {
                // Handle the case where only one service is selected
                $accommodations_query->whereHas('services', function ($query) use ($services) {
                    $query->where('service_id', $services);
                });
            }
        }

        // Execute the query
        $accommodations = $accommodations_query->get();

        // Return the result
        return response()->json([
            'success' => true,
            'res' => $accommodations
        ]);
    }
}
