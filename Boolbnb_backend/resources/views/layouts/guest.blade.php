<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('', 'Account') }}</title>
    {{-- <title>{{ config('app.name', 'Register') }}</title> --}}

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased">
    <div class="gradient-background min-h-screen flex sm:justify-center items-center pt-6 sm:pt-0">

        <div>
            <x-application-logo class="w-20 h-20 fill-current text-gray-500" />

            <div>img</div>
            <p>Whether you have a spare room or an entire home, hosting with us opens up a world of opportunities</p>
        </div>



        <div class="guest w-full sm:max-w-md mt-6 bg-white overflow-hidden sm:rounded-lg" style="padding: 45px">
            {{ $slot }}
        </div>

    </div>
</body>

</html>

<style>
    .gradient-background{
        background: linear-gradient(to bottom, #00CBD8, #B844FF) left,
                    linear-gradient(to top, #ffffff, #ffffff) right;
        background-size: 70% 100%, 30% 100%;
        background-repeat: no-repeat;
    }
    .guest{
        position: relative;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    }
    p{
        font-size: 40px;
        width: 350px;
        margin-top: 150px;
        margin-right: 100px;
        color: white;
        font-family: "Open Sans", sans-serif;
        font-weight: 700;
        font-style: normal;
    }
</style>
