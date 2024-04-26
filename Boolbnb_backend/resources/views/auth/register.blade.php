<x-guest-layout>

    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name *')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Surname -->
        <div class="mt-4">
            <x-input-label for="surname" :value="__('Surname *')" />
            <x-text-input id="surname" class="block mt-1 w-full" type="text" name="surname" :value="old('surname')"
                required autocomplete="surname" />
            <x-input-error :messages="$errors->get('surname')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email *')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password *')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password *')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        {{-- DATA DI COMPLEANNO --}}
        <div class="mt-4">
            <x-input-label for="birth_date" :value="__('Birth Date *')" />
            <input id="birth_date" type="date" name="birth_date" value="{{ old('birth_date') }}" required autofocus
                autocomplete="birth_date" class="form-input rounded-md shadow-sm mt-1 block w-full"
                max="{{ \Carbon\Carbon::now()->subYears(18)->format('Y-m-d') }}"
                min="{{ \Carbon\Carbon::now()->subYears(110)->format('Y-m-d') }}">
            <x-input-error :messages="$errors->get('birth_date')" class="mt-2" />
        </div>

        {{-- NUMERINO --}}
        <div class="mt-4">
            <x-input-label for="phone_number" :value="__('Phone Number')" />
            <input id="phone_number" type="text" name="phone_number" value="{{ old('phone_number') }}" autofocus
                autocomplete="phone_number" class="form-input rounded-md shadow-sm mt-1 block w-full"
                pattern="[\d\s+]*">
            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
        </div>

        {{-- foto --}}
        <div class="mt-4">
            <x-input-label for="user_propic" :value="__('Your Porfile Picture *')" />
            <input type="file" name="user_propic" id="user_propic" class="my-2">
            <x-input-error :messages="$errors->get('user_propic')" class="mt-2" />
        </div>


        {{-- bottoni per fare cose --}}
        <div>
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-300 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="ms-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </div>

    </form>
</x-guest-layout>
