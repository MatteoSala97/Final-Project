<?php

namespace App\Http\Controllers;

use App\Models\Accomodation;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the reservations for accommodations owned by the authenticated user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservations = auth()->user()->reservationsAsHost()->with(['accommodation', 'guest'])->paginate(5);

        return view('pages.accomodation.reservations', compact('reservations'));
    }



    /**
     * Get all reservations made by the authenticated user.
     *
     * @return \Illuminate\Http\Response
     */
    public function getReservations()
    {
        $user = auth()->user();
        $reservations = $user->reservationsAsGuest;

        return response()->json($reservations);
    }

    /**
     * Store a newly created reservation in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'accomodation_id' => 'required|exists:accomodations,id',
            'guest_id' => 'required|exists:users,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        // Fetch the user_id (host) from the accomodation_id
        $accommodation = Accomodation::findOrFail($request->accomodation_id);
        $user_id = $accommodation->user_id;

        $reservation = new Reservation();
        $reservation->user_id = $user_id; // Assign host's user_id
        $reservation->guest_id = $request->guest_id; // Assign guest_id from the request
        $reservation->accomodation_id = $request->accomodation_id;
        $reservation->start_date = $request->start_date;
        $reservation->end_date = $request->end_date;
        // You may need to fill in other fields here like status, price, etc.
        $reservation->save();

        return response()->json($reservation, 201);
    }
}
