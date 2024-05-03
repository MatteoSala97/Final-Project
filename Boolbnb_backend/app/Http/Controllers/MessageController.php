<?php

namespace App\Http\Controllers;

use App\Mail\NewContact;
use App\Models\Accomodation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();
        $rules = [
            'accomodation_id' => 'required|exists:accomodations,id',
            'name' => 'required|string',
            'email' => 'required|email',
            'content' => 'required|string',
        ];

        $validated_data = $request->validate($rules);
        $selected_accomodation = Accomodation::findOrFail($validated_data['accomodation_id']);
        $user_id = $selected_accomodation->user_id;
        $owner_mail = User::findOrFail($user_id)->email;
        $new_message = Message::create($validated_data);
        Mail::to($owner_mail)->send(new NewContact($new_message));
    }



    public function index()
    {
        $user = auth()->user();

        // Retrieve messages related to accommodations owned by the user
        $messages = Message::with('accomodation')
            ->join('accomodations', 'messages.accomodation_id', '=', 'accomodations.id')
            ->where('accomodations.user_id', $user->id)
            ->orderBy('messages.created_at', 'desc')
            ->paginate(5);

        // Pass the retrieved messages to the view
        return view('pages.accomodation.messages', compact('messages'));
    }
}
