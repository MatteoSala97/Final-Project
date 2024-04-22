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
                    class="form-control
                    @error('title') is-invalid @enderror"
                />
                @error('title')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="type" class="form-label">type</label>
                <input
                    type="text"
                    name="type"
                    id="type"
                    placeholder="..."
                    class="form-control
                    @error('type') is-invalid @enderror"
                />
                @error('type')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="rooms" class="form-label">rooms</label>
                <input
                    type="text"
                    name="rooms"
                    id="rooms"
                    placeholder="..."
                    class="form-control
                    @error('rooms') is-invalid @enderror"
                />
                @error('rooms')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="beds" class="form-label">beds</label>
                <input
                    type="text"
                    name="beds"
                    id="beds"
                    placeholder="..."
                    class="form-control
                    @error('beds') is-invalid @enderror"
                />
                @error('beds')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="bathrooms" class="form-label">bathrooms</label>
                <input
                    type="text"
                    name="bathrooms"
                    id="bathrooms"
                    placeholder="..."
                    class="form-control
                    @error('bathrooms') is-invalid @enderror"
                />
                @error('bathrooms')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">address</label>
                <input
                    type="text"
                    name="address"
                    id="address"
                    placeholder="..."
                    class="form-control
                    @error('address') is-invalid @enderror"
                />
                @error('address')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="city" class="form-label">city</label>
                <input
                    type="text"
                    name="city"
                    id="city"
                    placeholder="..."
                    class="form-control
                    @error('city') is-invalid @enderror"
                />
                @error('city')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="latitude" class="form-label">latitude</label>
                <input
                    type="text"
                    name="latitude"
                    id="latitude"
                    placeholder="..."
                    class="form-control
                    @error('latitude') is-invalid @enderror"
                />
                @error('latitude')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="longitude" class="form-label">longitude</label>
                <input
                    type="text"
                    name="longitude"
                    id="longitude"
                    placeholder="..."
                    class="form-control
                    @error('longitude') is-invalid @enderror"
                />
                @error('longitude')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">price</label>
                <input
                    type="text"
                    name="price"
                    id="price"
                    placeholder="..."
                    class="form-control
                    @error('price') is-invalid @enderror"
                />
                @error('price')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="hidden" class="form-label">hidden</label>
                <input
                    type="text"
                    name="hidden"
                    id="hidden"
                    placeholder="..."
                    class="form-control
                    @error('hidden') is-invalid @enderror"
                />
                @error('hidden')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="thumb" class="form-label">thumb</label>
                <input
                    type="text"
                    name="thumb"
                    id="thumb"
                    placeholder="..."
                    class="form-control
                    @error('thumb') is-invalid @enderror"
                />
                @error('thumb')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="host thumb" class="form-label">host thumb</label>
                <input
                    type="text"
                    name="host thumb"
                    id="host thumb"
                    placeholder="..."
                    class="form-control
                    @error('host thumb') is-invalid @enderror"
                />
                @error('host thumb')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="rating" class="form-label">rating</label>
                <input
                    type="text"
                    name="rating"
                    id="rating"
                    placeholder="..."
                    class="form-control
                    @error('rating') is-invalid @enderror"
                />
                @error('rating')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="user" class="form-label">user</label>
                <input
                    type="text"
                    name="user"
                    id="user"
                    placeholder="..."
                    class="form-control
                    @error('user') is-invalid @enderror"
                />
                @error('user')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                @enderror
            </div>


            <button type="submit" class="btn btn-success">Conferma creazione</button>

        </form>
    </div>

</body>
</html>
