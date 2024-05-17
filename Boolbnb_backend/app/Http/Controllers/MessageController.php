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
        $owner_email = $selected_accomodation->user->email;
        $validated_data['recipient_email'] = $owner_email;

        $owner_mail = User::findOrFail($user_id)->email;
        $new_message = Message::create($validated_data);
        Mail::to($owner_mail)->send(new NewContact($new_message));
    }



    public function index()
    {
        $user = auth()->user();

        // Retrieve accommodations owned by the user
        $accomodations = Accomodation::where('user_id', $user->id)->get();

        // Retrieve messages related to accommodations owned by the user
        $messages = Message::with('accomodation')
            ->join('accomodations', 'messages.accomodation_id', '=', 'accomodations.id')
            ->select('messages.id as message_id', 'messages.created_at as message_created_at', 'accomodations.id as accomodation_id', 'accomodations.host_thumb as accomodation_host_thumb', 'accomodations.title as accomodation_title', 'messages.*')
            ->where('accomodations.user_id', $user->id)
            ->orderBy('messages.created_at', 'desc')
            ->paginate(5);

        // Pass both messages and accommodations to the view
        return view('pages.accomodation.messages', compact('messages', 'accomodations'));
    }


    public function show(Message $message)
    {
        return view('pages.accomodation.messages.show', compact('message'));
    }

    public function userMessagesApi(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $user = User::findOrFail($request->user_id);

        $sent_messages = Message::where('email', $user->email)->get();
        $received_messages = Message::where('recipient_email', $user->email)->get();

        return response()->json(['sent_messages' => $sent_messages, 'received_messages' => $received_messages], 200);
    }

    public function reply(Request $request)
    {

        $user = auth()->user();
        $request->merge([
            'name' => $user->name . ' ' . $user->surname,
            'email' => $user->email,
        ]);

        $rules = [
            'accomodation_id' => 'required|exists:accomodations,id',
            'name' => 'required|string',
            'email' => 'required|email',
            'recipient_email' => 'email',
            'content' => 'required|string',
        ];
        // dd($data);

        $validated_data = $request->validate($rules);

        $recipient_email = $validated_data['recipient_email'];
        $new_message = Message::create($validated_data);
        Mail::to($recipient_email)->send(new NewContact($new_message));
        $message = $new_message;
        return view('pages.accomodation.messages.show', compact('message'));
    }
}
