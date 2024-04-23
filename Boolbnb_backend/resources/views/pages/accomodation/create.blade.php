<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

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

    <div class="container">

        <div class="my-4">
            <h2>Register new accommodaiton</h2>
        </div>

        <form action="{{route('dashboard.accomodations.store')}}" method="POST"
            enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Accommodation Title</label>
                <input type="text" name="title" id="title" placeholder="Your title here"
                    class="form-control
                    @error('title') is-invalid @enderror" @required(true) />
                @error('title')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="type" class="form-label">Accommodation Type</label>
                <select name="type" id="type" class="form-control">
                    <option value="House">House</option>
                    <option value="Apartment">Apartment</option>
                    <option value="Hotel">Hotel</option>
                    <option value="GuestHouse">GuestHouse</option>
                </select>
                @error('type')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="mb-3 d-flex gap-5">
                <div>
                    <label for="rooms" class="form-label">Number of Bedrooms</label>
                    <input type="number" name="rooms" id="rooms"
                        class="form-control
                        @error('rooms') is-invalid @enderror" value="1"
                        min="1" />
                    @error('rooms')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div>
                    <label for="beds" class="form-label">Number of Beds</label>
                    <input type="number" name="beds" id="beds"
                        class="form-control
                        @error('beds') is-invalid @enderror" value="1"
                        min="1" />
                    @error('beds')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div>
                    <label for="bathrooms" class="form-label">Number of Bathrooms</label>
                    <input type="number" name="bathrooms" id="bathrooms"
                        class="form-control
                        @error('bathrooms') is-invalid @enderror"
                        value="1" min="1" />
                    @error('bathrooms')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="d-flex gap-5 mb-3">
                <div class="w-50">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" name="address" id="address" placeholder="Your address here"
                        class="form-control
                        @error('address') is-invalid @enderror"
                        @required(true) />
                    @error('address')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="w-25">
                    <label for="city" class="form-label">City</label>
                    <input type="text" name="city" id="city" placeholder="..."
                        class="form-control
                        @error('city') is-invalid @enderror" />
                    @error('city')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>


            <div class="d-flex gap-5 mb-3 align-items-center">
                <div class="mb-3 w-75">
                    <label for="price_per_night" class="form-label">Price per Night</label>
                    <input type="range" class="form-range" min="0" max="500" step="10" value="0"
                        id="price_per_night" name="price_per_night">
                    <div id="price_display">Price: €0</div>
                    @error('price_per_night')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                <div class="mb-3">

                    <input type="checkbox" name="hidden" id="hidden"
                        class="form-check-input
                        @error('hidden') is-invalid @enderror" />
                    <label for="hidden" class="form-check-label">Show on BoolBnB</label>
                    @error('hidden')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            {{-- //TODO - handle multiple uploads --}}

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



            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault" @required(true)>
                    Confirm correctness of entered information
                </label>
            </div>

            <div class="my-5">
                <h5 class="mb-3">
                    What services does your accommodation offer?
                </h5>
                <div class="mb-3 d-flex gap-4 form-check flex-wrap ">
                    @foreach ($services as $service)
                        <div class="my-3 me-3">
                            <input type="checkbox" name="services[]" id="service_{{ $service->id }}"
                                value="{{ $service->id }}" class="form-check-input" />
                            <label
                                for="service_{{ $service->id }}"class="form-check-label">{{ $service->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>




            <button type="submit" class="btn btn-success">Confirm</button>

        </form>
    </div>

</body>
</html>

<script>
    const priceRange = document.getElementById('price_per_night');
    const priceDisplay = document.getElementById('price_display');

    priceRange.addEventListener('input', function() {
        priceDisplay.innerText = 'Price: €' + priceRange.value;
    });
</script>
