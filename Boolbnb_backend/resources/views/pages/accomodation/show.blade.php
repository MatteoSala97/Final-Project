<x-app-layout>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Show</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <!-- Fonts -->
        {{-- <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> --}}

        <!-- Scripts -->
        {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

    </head>

    <body>

        <div class="d-flex justify-content-center my-3">
            <div class="card " style="width: 18rem;">
                {{-- possible conflict between  url and local path --}}
                @if ($accomodation->thumb)
                    <img src="{{ asset($accomodation->thumb) }}" class="card-img-top" alt="...">
                @endif

                <div class="card-body">
                    <h5 class="card-title">{{ $accomodation->title }}</h5>
                    <p class="card-text">{{ $accomodation->address }}, {{ $accomodation->city }}</p>
                </div>
            </div>
        </div>


    </body>

    </html>

</x-app-layout>
