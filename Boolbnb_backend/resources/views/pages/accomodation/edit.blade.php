<x-app-layout>
    <div class="container m-5 w-9/12">

        <div class="my-5">
            <a href="{{ route('dashboard') }}" class="btn btn-primary d-flex align-items-center">
                <p class="font-bold text-xl">
                    < Change accommodation</p>
            </a>
        </div>

        <form class="ms-4" action="{{ route('dashboard.accomodations.update', $accomodation->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf @method('PUT')

            {{-- title --}}
            <div class="mb-3">
                <x-input-label for="title" :value="__('Title')" class="text-black" />
                <input type="text" name="title" id="title" placeholder="Your title here"
                    class="block mt-1 w-full rounded-md border-gray-300"
                    value="{{ old('title', $accomodation->title) }}" />
            </div>

            {{-- address city --}}
            <div class="flex justify-between gap-5">
                {{-- address --}}
                <div class="w-1/2 address-input-group mb-3">
                    <x-input-label for="address" :value="__('Full address')" class="text-black" />
                    <input type="text" name="address" id="address" placeholder="Your address here"
                        class="block mt-1 w-full rounded-md border-gray-300"
                        value="{{ old('address', $accomodation->address) }}" />
                </div>

                {{-- city --}}
                <div class="w-1/2 address-input-group mb-3">
                    <x-input-label for="city" :value="__('City')" class="text-black" />
                    <input type="text" name="city" id="city" placeholder="..."
                        class="block mt-1 w-full rounded-md border-gray-300"
                        value="{{ old('city', $accomodation->city) }}" />
                </div>
            </div>

            {{-- type rooms beds bathrooms --}}
            <div class="flex justify-between gap-5">
                <!-- type -->
                <div class="mb-3 w-full">
                    <x-input-label for="type" :value="__('Type')" class="text-black" />
                    <select name="type" id="type" class="block mt-1 rounded-md w-full border-gray-300">
                        <option value="House" {{ old('type', $accomodation->type) == 'House' ? 'selected' : '' }}>House
                        </option>
                        <option value="Apartment"
                            {{ old('type', $accomodation->type) == 'Apartment' ? 'selected' : '' }}>
                            Apartment</option>
                        <option value="Hotel" {{ old('type', $accomodation->type) == 'Hotel' ? 'selected' : '' }}>Hotel
                        </option>
                        <option value="GuestHouse"
                            {{ old('type', $accomodation->type) == 'GuestHouse' ? 'selected' : '' }}>
                            GuestHouse</option>
                    </select>
                </div>

                {{-- rooms --}}
                <div class="mb-3 w-full">
                    <x-input-label for="rooms" :value="__('Bedrooms')" class="text-black" />
                    <input type="number" name="rooms" id="rooms"
                        class="block mt-1 rounded-md w-full border-gray-300"
                        value="{{ old('rooms', $accomodation->rooms) }}" min="1" />

                </div>

                {{-- beds --}}
                <div class="mb-3 w-full">
                    <x-input-label for="beds" :value="__('Beds')" class="text-black" />
                    <input type="number" name="beds" id="beds"
                        class="block mt-1 rounded-md w-full border-gray-300"
                        value="{{ old('beds', $accomodation->beds) }}" min="1" />

                </div>

                {{-- bathrooms --}}
                <div class="mb-3 w-full">
                    <x-input-label for="bathrooms" :value="__('Bathrooms')" class="text-black" />
                    <input type="number" name="bathrooms" id="bathrooms" value="{{ old('bathrooms') ?? 1 }}"
                        class="block mt-1 rounded-md w-full border-gray-300
                        @error('bathrooms') is-invalid @enderror"
                        min="1" />

                </div>
            </div>

            {{-- thumb --}}
            <div class="mb-3">
                <x-input-label for="user_propic" :value="__('Thumbnail')" class="text-black" />

                <label id="file-name-container" for="user_propic"
                    class="form-input rounded-md shadow-sm mt-1 block w-full border-gray-300 text-gray-500 @error('thumb') is-invalid @enderror">
                    Seleziona un file
                </label>
                <input class="form-control  @error('thumb') is-invalid @enderror" type="file" id="thumb"
                    name="thumb">
                @error('thumb')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror


            </div>

            {{-- prezzo notte --}}
            <div class="flex justify-between items-center gap-5">
                <div>
                    <x-input-label for="range" :value="__('Price per night')" class="text-black" />
                    <div id="price_display" class="block mt-1 w-full rounded-md bg-white p-2 border border-gray-300">
                        € {{ old('price_per_night', $accomodation->price_per_night) }}
                    </div>
                </div>

                <div class="flex-grow mr-5 mt-5">
                    <x-input-label for="price_per_night" :value="__('')" />

                    <input type="range" class="form-range w-full mt-2" min="0" max="500" step="10"
                        value="{{ old('price_per_night', $accomodation->price_per_night) }}" id="price_per_night"
                        name="price_per_night">
                </div>
            </div>

            {{-- service --}}
            <div class="my-5">
                <x-input-label for="range" :value="__('Price per night')" class="text-black" />
                <div id="price_display" class="mt-1 w-full rounded-md">
                    Choose one or more services
                </div>

                <div class="mb-3 flex flex-wrap">
                    @foreach ($services as $service)
                        <div class="my-3 me-3 w-2/12">
                            <input type="checkbox" name="services[]" id="service_{{ $service->id }}"
                                value="{{ $service->id }}" class="form-checkbox h-5 w-5 text-blue-500"
                                {{ in_array($service->id, old('services', [])) ? 'checked' : '' }}>
                            <label for="service_{{ $service->id }}"
                                class="ml-2 text-sm text-gray-700">{{ $service->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- <x-primary-button type="submit">Confirm Edit</x-primary-button> --}}
            <x-button-gradient type="submit">
                <button class="uppercase">Confirm Edit</button>
            </x-button-gradient>

        </form>
    </div>
</x-app-layout>

<script>
    const priceRange = document.getElementById('price_per_night');
    const priceDisplay = document.getElementById('price_display');
    const address_input = document.getElementById('address');
    const city_input = document.getElementById('city');
    const selected_address_input = document.getElementById('selected_address');
    const dropdown_menu = document.getElementById('create-dropdown')

    console.log(address_input)

    priceRange.addEventListener('input', function() {
        priceDisplay.innerText = '€ ' + priceRange.value;
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
            const icon = document.createElement('div')
            icon.innerHTML =
                '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z"/></svg>'
            menu_voice.classList.add('dropdown-item');
            menu_voice.innerText = address
            menu_voice.prepend(icon)
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


    // img
    var inputFile = document.getElementById('user_propic');

    inputFile.addEventListener('change', function() {
        var fileName = inputFile.files[0].name;
        var fileNameContainer = document.getElementById('file-name-container');
        fileNameContainer.textContent = 'Selected file: ' + fileName;
    });
</script>

<style>
    .dropdown-item {
        padding-left: 30px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .dropdown-item svg {
        width: 10px;
        fill: white;
    }

    input[type="file"] {
        display: none;
    }

    input[type="range"] {
        -webkit-appearance: none;
        appearance: none;
        width: 100%;
        height: 10px;
        background-color: transparent;
        border-radius: 5px;
    }

    input[type="range"]::-webkit-slider-runnable-track {
        width: 100%;
        height: 5px;
        background-color: black;
        border-radius: 10px;
    }

    input[type="range"]::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 25px;
        height: 25px;
        background-color: rgb(255, 255, 255);
        border: 1px solid rgb(135, 135, 135);
        border-radius: 50%;
        cursor: pointer;
        margin-top: -10px;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.3);
    }
</style>
