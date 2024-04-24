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

    <div class="container">

        <div class="my-4">
            <h2>Register new accommodaiton</h2>
        </div>

        <form action="{{ route('dashboard.accomodations.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Accommodation Title</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}"
                    placeholder="Your title here"
                    class="form-control
                    @error('title') is-invalid @enderror" @required(true) />
                @error('title')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="type" class="form-label">Accommodation Type</label>
                <select name="type" id="type" class="form-control">
                    <option value="House" {{ old('type') == 'House' ? 'selected' : '' }}>House</option>
                    <option value="Apartment" {{ old('type') == 'Apartment' ? 'selected' : '' }}>Apartment</option>
                    <option value="Hotel" {{ old('type') == 'Hotel' ? 'selected' : '' }}>Hotel</option>
                    <option value="GuestHouse" {{ old('type') == 'GuestHouse' ? 'selected' : '' }}>GuestHouse</option>
                </select>
                @error('type')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3 d-flex gap-5">
                <div>
                    <label for="rooms" class="form-label">Number of Bedrooms</label>
                    <input type="number" name="rooms" id="rooms" value="{{ old('rooms') ?? 1 }}"
                        class="form-control
                        @error('rooms') is-invalid @enderror" min="1"
                        @required(true) />
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
                        @error('beds') is-invalid @enderror"
                        value="{{ old('beds') ?? 1 }}" min="1" />
                    @error('beds')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div>
                    <label for="bathrooms" class="form-label">Number of Bathrooms</label>
                    <input type="number" name="bathrooms" id="bathrooms" value="{{ old('bathrooms') ?? 1 }}"
                        class="form-control
                        @error('bathrooms') is-invalid @enderror"
                        min="1" />
                    @error('bathrooms')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>



            <div class="d-flex gap-5 mb-3 align-items-center">
                <div class="w-50 address-input-group">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" name="address" id="address" placeholder="Your address here"
                        class="form-control
                        @error('address') is-invalid @enderror"
                        @required(true) value="{{ old('address') }}" autocomplete="off" />
                    @error('address')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <ul class="dropdown-menu-dark w-full" id="create-dropdown">
                    </ul>
                    {{-- this hidden input will carry the actual value of the position --}}
                    <input type="hidden" name="selected_address" id="selected_address">
                </div>


                {{-- <div class="w-25">
                    <label for="cap" class="form-label">ZIP Code</label>
                    <input type="text" name="cap" value="{{ old('cap') }}" id="cap"
                        class="form-control" pattern="\d*" @required(true) />
                </div> --}}

                <div class="w-25">
                    <label for="city" class="form-label">City</label>
                    <input type="text" name="city" id="city" placeholder="Your city here" @required(true)
                        value="{{ old('city') }}"
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
                    <input type="range" class="form-range" min="0" max="500" step="10"
                        value="{{ old('price_per_night') ? old('price_per_night') : '0' }}" id="price_per_night"
                        name="price_per_night">
                    <div id="price_display">Price: {{ old('price_per_night') ? '€' . old('price_per_night') : '0' }}
                    </div>
                    @error('price_per_night')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                {{-- <div class="mb-3">

                    <input type="checkbox" name="hidden" id="hidden" {{ old('hidden') ? 'checked' : '' }}
                        class="form-check-input
                        @error('hidden') is-invalid @enderror" />
                    <label for="hidden" class="form-check-label">Hide on BoolBnB</label>
                    @error('hidden')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div> --}}
            </div>

            {{-- //TODO - handle multiple uploads --}}

            <div class="mb-3">
                <label for="thumb" class="form-label">
                    Upload Thumbnail Image
                </label>
                <input class="form-control @error('thumb') is-invalid @enderror" type="file" id="thumb"
                    name="thumb">
                @error('thumb')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>




            <div class="my-5">
                <h5 class="mb-3">
                    What services does your accommodation offer?
                </h5>
                <div class="mb-3 d-flex gap-4 form-check flex-wrap">
                    @foreach ($services as $service)
                        <div class="my-3 me-3">
                            <input type="checkbox" name="services[]" id="service_{{ $service->id }}"
                                value="{{ $service->id }}" class="form-check-input"
                                {{ in_array($service->id, old('services', [])) ? 'checked' : '' }}>
                            <label for="service_{{ $service->id }}"
                                class="form-check-label">{{ $service->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- <div class="form-check mb-3 fw-bold">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"
                    @required(true)>
                <label class="form-check-label" for="flexCheckDefault">
                    Confirm correctness of entered information
                </label>
            </div> --}}




            <button type="submit" class="btn btn-success">Confirm</button>

        </form>
    </div>

</body>

</html>

<script>
    const priceRange = document.getElementById('price_per_night');
    const priceDisplay = document.getElementById('price_display');
    const address_input = document.getElementById('address');
    const city_input = document.getElementById('city');
    const selected_address_input = document.getElementById('selected_address');
    const dropdown_menu = document.getElementById('create-dropdown')

    console.log(address_input)

    priceRange.addEventListener('input', function() {
        priceDisplay.innerText = 'Price: €' + priceRange.value;
    });

    function editDropdownMenu(list) {
        dropdown_menu.innerHTML = ''
        console.log(dropdown_menu)
        list.forEach((position) => {
            const menu_voice = document.createElement('li');
            const address = position.address.freeformAddress
            const city = position.address.municipality
            const latitude = position.position.lat
            const longitude = position.position.lon
            menu_voice.classList.add('dropdown-item');
            menu_voice.innerText = address
            dropdown_menu.append(menu_voice)
            menu_voice.addEventListener('click', () => {
                address_input.value = address
                city_input.value = city
                dropdown_menu.innerHTML = ''
                let selected_address = {
                    address,
                    city,
                    latitude,
                    longitude
                }
                const selectedAddressJSON = JSON.stringify(selected_address);
                console.log(selectedAddressJSON);
                selected_address_input.value = selectedAddressJSON

            })
        })
    }

    function debounce(func, delay) {
        let timeoutId;
        return function(...args) {
            clearTimeout(timeoutId);
            timeoutId = setTimeout(() => {
                func.apply(this, args);
            }, delay);
        };
    }


    address_input.addEventListener('input', debounce((e) => {
        let address = e.target.value;
        const api_url = 'http://127.0.0.1:8000/api/get-address-suggestions?address=';

        if (address.length >= 5) {
            fetch(api_url + encodeURIComponent(address))
                .then(res => {
                    if (!res.ok) {
                        console.log('network error');
                    } else {
                        return res.json();
                    }
                })
                .then(data => {
                    let suggested_addresses = [];
                    console.log(data.results[0]);
                    data.results.forEach(position => {
                        suggested_addresses.push(position);
                    });
                    editDropdownMenu(suggested_addresses.slice(0, 5));
                })
                .catch(err => {
                    console.log(err);
                });
        }
    }, 300))
</script>

<style>
    .dropdown-item {
        padding-left: 30px;
        cursor: pointer;
    }
</style>
