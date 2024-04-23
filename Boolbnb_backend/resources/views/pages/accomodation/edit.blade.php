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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Scripts -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
</head>

<body>
    <div class="container my-3">

        <div class="my-4">
            <h2>Change accommodation</h2>
        </div>

        <form action="{{ route('dashboard.accomodations.update', $accomodation->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- title --}}
            <div class="mb-3">
                <label for="title" class="form-label">Accommodation Title</label>
                <input type="text" name="title" id="title" placeholder="Your title here" class="form-control"
                    value="{{ old('title', $accomodation->title) }}" />
            </div>

            {{-- type --}}
            <div class="mb-3">
                <label for="type" class="form-label">Accommodation Type</label>
                <select name="type" id="type" class="form-control">
                    <option value="House" {{ old('type', $accomodation->type) == 'House' ? 'selected' : '' }}>House
                    </option>
                    <option value="Apartment" {{ old('type', $accomodation->type) == 'Apartment' ? 'selected' : '' }}>
                        Apartment</option>
                    <option value="Hotel" {{ old('type', $accomodation->type) == 'Hotel' ? 'selected' : '' }}>Hotel
                    </option>
                    <option value="GuestHouse" {{ old('type', $accomodation->type) == 'GuestHouse' ? 'selected' : '' }}>
                        GuestHouse</option>
                </select>
            </div>

            {{-- rooms beds bathrooms --}}
            <div class="mb-3 d-flex gap-5">
                <div>
                    <label for="rooms" class="form-label">Number of Bedrooms</label>
                    <input type="number" name="rooms" id="rooms" class="form-control"
                        value="{{ old('rooms', $accomodation->rooms) }}" min="1" />
                </div>

                <div>
                    <label for="beds" class="form-label">Number of Beds</label>
                    <input type="number" name="beds" id="beds" class="form-control"
                        value="{{ old('beds', $accomodation->beds) }}" min="1" />
                </div>

                <div>
                    <label for="bathrooms" class="form-label">Number of Bathrooms</label>
                    <input type="number" name="bathrooms" id="bathrooms" class="form-control"
                        value="{{ old('bathrooms', $accomodation->bathrooms) }}" min="1" />
                </div>
            </div>

            {{-- address city --}}
            <div class="d-flex gap-5 mb-3">
                <div class="w-50">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" name="address" id="address" placeholder="Your address here"
                        class="form-control" value="{{ old('address', $accomodation->address) }}" />
                </div>

                <div class="w-25">
                    <label for="city" class="form-label">City</label>
                    <input type="text" name="city" id="city" placeholder="..." class="form-control"
                        value="{{ old('city', $accomodation->city) }}" />
                </div>
            </div>

            {{-- price_per_night hidden --}}
            <div class="d-flex gap-5 mb-3 align-items-center">
                <div class="mb-3 w-75">
                    <label for="price_per_night" class="form-label">Price per Night</label>

                    <input type="range" class="form-range" min="0" max="500" step="10" value="0"
                        id="price_per_night" name="price_per_night"
                        value="{{ old('price_per_night', $accomodation->price_per_night) }}">
                    <div id="price_display">Price: €{{ old('price_per_night', $accomodation->price_per_night) }}</div>
                </div>

                {{-- <div class="mb-3">
                    <input type="checkbox" name="hidden" id="hidden" class="form-check-input"
                        value="{{ old('hidden', $accomodation->hidden) }}" />
                    <label for="hidden" class="form-check-label">Show on BoolBnB</label>
                </div> --}}
            </div>

            {{-- host_thumb --}}


            <div class="mb-3">
                <label for="thumb" class="form-label">
                    Upload Thumbnail Image
                </label>
                <input class="form-control" type="file" id="thumb" name="thumb">
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


            {{-- flexCheckDefault --}}


            {{-- services --}}
            <div class="my-5">
                <h5 class="mb-3">
                    Selected services
                </h5>
                <div class="mb-3 d-flex gap-4 form-check flex-wrap">
                    @foreach ($services as $service)
                        <div class="my-3 me-3">
                            <input type="checkbox" name="services[]" id="service_{{ $service->id }}"
                                value="{{ $service->id }} services" class="form-check-input" />

                            <label for="service_{{ $service->id }}"class="form-check-label">{{ $service->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="btn btn-success">Confirm MODIFICAAAA</button>

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
