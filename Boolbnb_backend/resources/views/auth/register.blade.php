<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" id="register-form">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" placeholder="Name *"
                :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Surname -->
        <div class="mt-4">
            <x-input-label for="surname" :value="__('')" />
            <x-text-input id="surname" class="block mt-1 w-full" type="text" name="surname" placeholder="Surname *"
                :value="old('surname')" required autocomplete="surname" />
            <x-input-error :messages="$errors->get('surname')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" placeholder="Email *"
                :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                placeholder="Password *" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
            <div id="password_error_container"></div>
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" placeholder="Confirm Password *" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        {{-- Birth Date --}}
        <div class="mt-4">
            <x-input-label for="birth_date" :value="__('')" />
            <x-text-input id="birth_date" type="date" name="birth_date" value="{{ old('birth_date') }}" required
                autofocus autocomplete="birth_date"
                class="form-input rounded-md shadow-sm mt-1 block w-full text-gray-500"
                max="{{ \Carbon\Carbon::now()->subYears(18)->format('Y-m-d') }}"
                min="{{ \Carbon\Carbon::now()->subYears(110)->format('Y-m-d') }}" />
            <x-input-error :messages="$errors->get('birth_date')" class="mt-2" />
        </div>

        {{-- Number --}}
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('')" />
            <x-text-input id="phone_number" type="text" name="phone_number" placeholder="Phone Number"
                value="{{ old('phone_number') }}" autofocus autocomplete="phone_number"
                class="form-input rounded-md shadow-sm mt-1 block w-full" pattern="[\d\s+]*" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        {{-- Picture --}}
        <div class="mt-4">
            <x-input-label for="user_propic" :value="__('')" />
            <label id="file-name-container" for="user_propic"
                class="form-input rounded-md shadow-sm mt-1 block w-full border-gray-300 text-gray-500">
                Select file
            </label>
            <input type="file" name="user_propic" id="user_propic">
            <x-input-error :messages="$errors->get('user_propic')" class="mt-2" />
        </div>

        {{-- Btn --}}
        <div class="flex justify-between items-center mt-4">
            {{-- Login --}}
            <a class="underline text-sm text-gray-400 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 "
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            {{-- Register --}}
            <x-primary-button class="Btn-sign-up ms-4">
                {{ __('Sign Up') }}
            </x-primary-button>
        </div>

        {{-- Number OLD
        <div class="mt-4">
                <x-input-label for="phone_number" :value="__('')" />
                <input id="phone_number" type="text" name="phone_number" placeholder="Phone Number" value="{{ old('phone_number') }}" autofocus
                autocomplete="phone_number" class="form-input rounded-md shadow-sm mt-1 block w-full"
                pattern="[\d\s+]*">
                <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
        </div> --}}

        {{-- Birth Date OLD
        <div class="mt-4">
            <x-input-label for="birth_date" :value="__('')" />
            <input id="birth_date" type="date" name="birth_date" placeholder="Birth Date *" value="{{ old('birth_date') }}" required autofocus
                autocomplete="birth_date" class="form-input rounded-md shadow-sm mt-1 block w-full"
                max="{{ \Carbon\Carbon::now()->subYears(18)->format('Y-m-d') }}"
                min="{{ \Carbon\Carbon::now()->subYears(110)->format('Y-m-d') }}">
            <x-input-error :messages="$errors->get('birth_date')" class="mt-2" />
        </div> --}}

        {{-- Picture OLD
        <div class="mt-4">
            <x-input-label for="user_propic" :value="__('')" />

            <input type="file" name="user_propic" id="user_propic" class="btn my-2 text-gray-500">

            <x-input-error :messages="$errors->get('user_propic')" class="mt-2" />
        </div> --}}

    </form>
</x-guest-layout>

<style>
    input[type="file"] {
        display: none;
    }
</style>

<script>
    var inputFile = document.getElementById('user_propic');
    const input_password = document.getElementById('password');
    const input_password_confrim = document.getElementById('password_confirmation');
    const register_form = document.getElementById('register-form');
    const pass_err_cont = document.getElementById('password_error_container');

    console.log(pass_err_cont)

    register_form.addEventListener('submit', (event) => {

        event.preventDefault();
        if (input_password.value.length !== input_password_confrim.value.length) {
            let errorMessage = `<x-input-error :messages="['Password length does not match']" class="mt-2" />`;
            pass_err_cont.innerHTML = errorMessage;
        } else {
            register_form.submit();
        }
    });


    inputFile.addEventListener('change', function() {
        var fileName = inputFile.files[0].name;
        var fileNameContainer = document.getElementById('file-name-container');
        fileNameContainer.textContent = 'Selected file: ' + fileName;
    });
</script>
