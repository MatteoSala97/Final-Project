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
    <div class="ciaooo flex justify-between min-h-screen items-center">

        <div class="logo-container">
            <x-logoM/>
            <p>Whether you have a spare room or an entire home, hosting with us opens up a world of opportunities</p>
        </div>

        <div>
            <div class="guest w-full max-w-md mt-6 p-8 bg-white overflow-hidden rounded-lg">
                {{ $slot }}
            </div>
        </div>

    </div>
</body>
</html>

<style>

    @media screen and (max-width: 1000px){
        .logo-container{
            display: none;
        }

        body{
            background-size: 100% 100%, 30% 100% !important;
        }

        .ciaooo{
            margin: 0 auto;
            justify-content: center;
        }

    }

    body{
        background: linear-gradient(to bottom, #00CBD8, #B844FF) left,
                    linear-gradient(to top, #ffffff, #ffffff) right;
        background-size: 70% 100%, 30% 100%;
        background-repeat: no-repeat;
    }
    .guest{
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    }
    p{
        font-size: 40px;
        width: 350px;
        margin-top: 150px;
        color: white;
        font-family: "Open Sans", sans-serif;
        font-weight: 700;
    }
    .ciaooo{
        width: 70%;
        margin: 0 auto;
    }


</style>
