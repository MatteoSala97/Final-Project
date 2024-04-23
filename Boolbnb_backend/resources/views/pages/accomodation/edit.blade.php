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

    <h1>EDIT</h1>

    <div class="container">

        <div class="my-4">
            <h2>Modifica</h2>
        </div>

        <form action="{{route('dashboard.accomodations.update', $accomodation->id)}}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

    {{-- title --}}
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input
                    type="text"
                    class="form-control"
                    name="title"
                    id="title"
                    placeholder="..."
                    value="{{old('title', $accomodation->title)}}"
                />
            </div>

    {{-- type --}}
            <div class="mb-3">
                <label for="type" class="form-label">type</label>
                <input
                    type="text"
                    class="form-control"
                    name="type"
                    id="type"
                    placeholder="..."
                    value="{{old('type', $accomodation->type)}}"
                />
            </div>

    {{-- rooms --}}
            <div class="mb-3">
                <label for="rooms" class="form-label">rooms</label>
                <input
                    type="text"
                    class="form-control"
                    name="rooms"
                    id="rooms"
                    placeholder="..."
                    value="{{old('rooms', $accomodation->rooms)}}"
                />
            </div>

    {{-- beds --}}
            <div class="mb-3">
                <label for="beds" class="form-label">beds</label>
                <input
                    type="text"
                    class="form-control"
                    name="beds"
                    id="beds"
                    placeholder="..."
                    value="{{old('beds', $accomodation->beds)}}"
                />
            </div>

    {{-- bathrooms --}}
            <div class="mb-3">
                <label for="bathrooms" class="form-label">bathrooms</label>
                <input
                    type="text"
                    class="form-control"
                    name="bathrooms"
                    id="bathrooms"
                    placeholder="..."
                    value="{{old('bathrooms', $accomodation->bathrooms)}}"
                />
            </div>

    {{-- address --}}
            <div class="mb-3">
                <label for="address" class="form-label">address</label>
                <input
                    type="text"
                    class="form-control"
                    name="address"
                    id="address"
                    placeholder="..."
                    value="{{old('address', $accomodation->address)}}"
                />
            </div>

    {{-- city --}}
            <div class="mb-3">
                <label for="city" class="form-label">city</label>
                <input
                    type="text"
                    class="form-control"
                    name="city"
                    id="city"
                    placeholder="..."
                    value="{{old('city', $accomodation->city)}}"
                />
            </div>

    {{-- price_per_night --}}
            <div class="mb-3">
                <label for="price_per_night" class="form-label">price_per_night</label>
                <input
                    type="text"
                    class="form-control"
                    name="price_per_night"
                    id="price_per_night"
                    placeholder="..."
                    value="{{old('price_per_night', $accomodation->price_per_night)}}"
                />
            </div>

            <div class="mb-3">
                <label for="hidden" class="form-label">hidden</label>
                <input
                    type="text"
                    class="form-control"
                    name="hidden"
                    id="hidden"
                    placeholder="..."
                    value="{{old('hidden', $accomodation->hidden)}}"
                />
            </div>
    {{-- thumb --}}
            <div class="mb-3">
                <label for="thumb" class="form-label">thumb</label>
                <input
                    type="text"
                    class="form-control"
                    name="thumb"
                    id="thumb"
                    placeholder="..."
                    value="{{old('thumb', $accomodation->thumb)}}"
                />
            </div>

    {{-- host_thumb --}}
            <div class="mb-3">
                <label for="host_thumb" class="form-label">host thumb</label>
                <input
                    type="text"
                    class="form-control"
                    name="host_thumb"
                    id="host_thumb"
                    placeholder="..."
                    value="{{old('host_thumb', $accomodation->host_thumb)}}"
                />
            </div>

    {{-- rating --}}
            <div class="mb-3">
                <label for="rating" class="form-label">rating</label>
                <input
                    type="text"
                    class="form-control"
                    name="rating"
                    id="rating"
                    placeholder="..."
                    value="{{old('rating', $accomodation->rating)}}"
                />
            </div>

    {{-- user_id --}}
            <div class="mb-3">
                <label for="user_id" class="form-label">user_id</label>
                <input
                    type="text"
                    class="form-control"
                    name="user_id"
                    id="user_id"
                    placeholder="..."
                    value="{{old('user_id', $accomodation->user_id)}}"
                />
            </div>

            <button type="submit" class="btn btn-success">Modifica</button>

        </form>
    </div>

</body>
</html>
