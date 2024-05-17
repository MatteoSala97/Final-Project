<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validate request data (e.g., email and password)
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate user
        if (auth()->attempt($credentials)) {
            $token = auth()->user()->createToken('authToken')->plainTextToken;
            return response()->json(['token' => $token, 'user' => auth()->user()], 200);
            return response()->json(['message' => 'Login successful', 'user' => auth()->user()], 200);
        } else {
            // Authentication failed
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    }

    public function register(Request $request)
    {

        $minDate = Carbon::now()->subYears(18)->format('Y-m-d');
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
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

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if ($request->hasFile('user_propic')) {

            $img_path = Storage::put('uploads', $request['user_propic']);
            $full_url = url('/') . '/storage/' . $img_path;
            $user_propic_filename = $full_url;
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

        $token = $user->createToken('authToken')->plainTextToken;

        event(new Registered($user));

        Auth::login($user);

        return response()->json(['message' => 'User successfully registered', 'user' => $user, 'token' => $token], 201);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        if (Auth::check()) {
            return response()->json(['message' => 'Logout failed'], 500);
        }

        return response()->json(['message' => 'Logout successful'], 200);
    }
}
