<?php

namespace App\Http\Controllers;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        // $user = Auth::user(); // Get the authenticated user

        // // Assuming your user model has a relationship with accommodations, you can fetch the messages related to the user's accommodations
        // $messages = Message::whereHas('accomodation', function ($query) use ($user) {
        //     $query->where('user_id', $user->id); // Assuming 'user_id' is the foreign key in the accommodations table that links to the users table
        // })->get();

        // return view('pages.accomodation.messages', compact('messages')); 




        // Retrieve the currently logged-in user
        $user = auth()->user();

        // Retrieve messages related to accommodations owned by the user
        $messages = Message::join('accomodations', 'messages.accomodation_id', '=', 'accomodations.id')
                            ->where('accomodations.user_id', $user->id)
                            ->get();

        // Pass the retrieved messages to the view
        return view('pages.accomodation.messages', compact('messages')); 
    }
}
