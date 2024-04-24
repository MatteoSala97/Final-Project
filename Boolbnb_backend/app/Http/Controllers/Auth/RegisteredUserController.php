<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        //Dynamically calculating if the registering user is at least 18


        $minDate = Carbon::now()->subYears(18)->format('Y-m-d');
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'birth_date' => ['nullable', 'date', 'before_or_equal:' . $minDate],
            'phone_number' => ['nullable', 'string', 'max:20', 'regex:/^[0-9+\s-]+$/'],
            'user_propic' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048']
        ], [
            'birth_date.before_or_equal' => 'You must be at least 18 years old to register.',
            'phone_number.regex' => 'The phone number format is invalid.',
            'user_propic.image' => 'Your picture must be an image.',
            'user_propic.mimes' => 'Your picture must be a file of type: jpeg, png, jpg, gif.',
            'user_propic.max' => 'Your picture may not be greater than 2 MB in size.',
        ]);


        if ($request->hasFile('user_propic')) {

            $img_path = Storage::put('uploads', $request['user_propic']);
            $user_propic_filename = basename($img_path);
        }

        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'birth_date' => $request->birth_date,
            'phone_number' => $request->phone_number,
            'user_propic' => $user_propic_filename ?? null
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
