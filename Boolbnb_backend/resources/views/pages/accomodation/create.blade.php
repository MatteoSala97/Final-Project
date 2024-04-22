<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        {{-- <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <!-- Scripts -->
        {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    </head>
<body>

    <h1>CREATE</h1>

    <div class="container">

        <div class="my-4">
            <h2>Creazione</h2>
        </div>

        <form action="{{route('dashboard.accomodations.store')}}" method="POST"
            enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">title</label>
                <input
                    type="text"
                    name="title"
                    id="title"
                    placeholder="..."
                    class="form-control"
                />
                {{-- @error('title')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                @enderror --}}
            </div>

            <div class="mb-3">
                <label for="rooms" class="form-label">rooms</label>
                <input
                    type="text"
                    name="rooms"
                    id="rooms"
                    placeholder="..."
                    class="form-control"
                />
                {{-- @error('rooms')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                @enderror --}}
            </div>

            <div class="mb-3">
                <label for="beds" class="form-label">beds</label>
                <input
                    type="text"
                    name="beds"
                    id="beds"
                    placeholder="..."
                    class="form-control"
                />
                {{-- @error('beds')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                @enderror --}}
            </div>

            <div class="mb-3">
                <label for="bathrooms" class="form-label">bathrooms</label>
                <input
                    type="text"
                    name="bathrooms"
                    id="bathrooms"
                    placeholder="..."
                    class="form-control"
                />
                {{-- @error('bathooms')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                @enderror --}}
            </div>

            <button type="submit" class="btn btn-success">Conferma creazione</button>

        </form>
    </div>

</body>
</html>
