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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Scripts -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
</head>

<body>

    <h1>CREATE</h1>

    <div class="container">

        <div class="my-4">
            <h2>Creazione</h2>
        </div>

        <form action="{{ route('dashboard.accomodations.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">title</label>
                <input type="text" name="title" id="title" placeholder="..."
                    class="form-control
                    @error('title') is-invalid @enderror" />
                @error('title')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="type" class="form-label">type</label>
                <input type="text" name="type" id="type" placeholder="..."
                    class="form-control
                    @error('type') is-invalid @enderror" />
                @error('type')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="rooms" class="form-label">rooms</label>
                <input type="text" name="rooms" id="rooms" placeholder="..."
                    class="form-control
                    @error('rooms') is-invalid @enderror" />
                @error('rooms')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="beds" class="form-label">beds</label>
                <input type="text" name="beds" id="beds" placeholder="..."
                    class="form-control
                    @error('beds') is-invalid @enderror" />
                @error('beds')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="bathrooms" class="form-label">bathrooms</label>
                <input type="text" name="bathrooms" id="bathrooms" placeholder="..."
                    class="form-control
                    @error('bathrooms') is-invalid @enderror" />
                @error('bathrooms')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">address</label>
                <input type="text" name="address" id="address" placeholder="..."
                    class="form-control
                    @error('address') is-invalid @enderror" />
                @error('address')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="city" class="form-label">city</label>
                <input type="text" name="city" id="city" placeholder="..."
                    class="form-control
                    @error('city') is-invalid @enderror" />
                @error('city')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            //TODO - switch to select

            <div class="mb-3">
                <label for="price_per_night" class="form-label">Price per Night</label>
                <input type="text" name="price_per_night" id="price_per_night" placeholder="..."
                    class="form-control
                    @error('price_per_night') is-invalid @enderror" />
                @error('price_per_night')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            //TODO - switch to checkbox
            <div class="mb-3">
                <label for="hidden" class="form-label">hidden</label>
                <input type="text" name="hidden" id="hidden" placeholder="..."
                    class="form-control
                    @error('hidden') is-invalid @enderror" />
                @error('hidden')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            //TODO- switch to file upload and do storage
            <div class="mb-3">
                <label for="thumb" class="form-label">thumb</label>
                <input type="text" name="thumb" id="thumb" placeholder="..."
                    class="form-control
                    @error('thumb') is-invalid @enderror" />
                @error('thumb')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="host_thumb" class="form-label">host thumb</label>
                <input type="text" name="host_thumb" id="host_thumb" placeholder="..."
                    class="form-control
                    @error('host_thumb') is-invalid @enderror" />
                @error('host_thumb')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="rating" class="form-label">rating</label>
                <input type="text" name="rating" id="rating" placeholder="..."
                    class="form-control
                    @error('rating') is-invalid @enderror" />
                @error('rating')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            //TODO - add logged user id
            <div class="mb-3">
                <label for="user_id" class="form-label">user_id</label>
                <input type="text" name="user_id" id="user_id" placeholder="..."
                    class="form-control
                    @error('user_id') is-invalid @enderror" />
                @error('user_id')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            <button type="submit" class="btn btn-success">Conferma creazione</button>

        </form>
    </div>

</body>

</html>
