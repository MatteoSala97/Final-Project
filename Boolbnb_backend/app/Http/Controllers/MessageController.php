<?php

namespace App\Http\Controllers;

use App\Mail\NewContact;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();
        $rules = [
            'accomodation_id' => 'required|exists:accomodations,id',
            'email' => 'required|email',
            'content' => 'required|string',
        ];
        $validated_data = $request->validate($rules);
        $new_message = Message::create($validated_data);
        Mail::to('mymail@gmail.com')->send(new NewContact($new_message));
    }



    public function index()
    {

        $user = auth()->user();

        // Retrieve messages related to accommodations owned by the user
        $messages = Message::join('accomodations', 'messages.accomodation_id', '=', 'accomodations.id')
            ->where('accomodations.user_id', $user->id)
            ->get();

        // Pass the retrieved messages to the view
        return view('pages.accomodation.messages', compact('messages'));
    }
}
