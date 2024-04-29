<x-app-layout>
    <div class="container m-5 w-9/12">

        <div class="my-5">
            <a href="{{ route('dashboard') }}" class="btn btn-primary d-flex align-items-center">
                <p class="font-bold text-xl">< Register new accommodaiton</p>
            </a>
        </div>

        <form class="ms-4" action="{{ route('dashboard.accomodations.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- title --}}
            <div class="mb-3 w-full">
                <x-input-label for="title" :value="__('Title *')" class="text-black"/>
                <input type="text" name="title" id="title" value="{{ old('title') }}"
                    placeholder="Accommodation title"
                    class="block mt-1 w-full rounded-md border-gray-300
                    @error('title') is-invalid @enderror" @required(true) />
                @error('title')
                    <div class="bg-red-200 p-5 rounded-md">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- address city--}}
            <div class="flex justify-between gap-5">

                {{-- address --}}
                <div class="w-1/2 address-input-group mb-3">
                    <x-input-label for="address" :value="__('Full address *')" class="text-black"/>
                    <input type="text" name="address" id="address" placeholder="Via Roma 50"
                        class="block mt-1 w-full rounded-md border-gray-300
                        @error('address') is-invalid @enderror"
                        @required(true) value="{{ old('address') }}" autocomplete="off" />
                    @error('address')
                        <div class="bg-red-200 p-5 rounded-md">
                            {{ $message }}
                        </div>
                    @enderror
                    <ul class="dropdown-menu-dark w-full" id="create-dropdown"></ul>
                    {{-- this hidden input will carry the actual value of the position --}}
                    <input type="hidden"  value="{{ old('selected_address') ?? '' }}" name="selected_address" id="selected_address">
                </div>

                {{-- city --}}
                <div class="w-1/2 address-input-group mb-3">
                    <x-input-label for="city" :value="__('City *')" class="text-black"/>
                    <input type="text" name="city" id="city" placeholder="Roma" @required(true)
                        value="{{ old('city') }}"
                        class="block mt-1 w-full rounded-md border-gray-300
                        @error('city') is-invalid @enderror" />
                    @error('city')
                        <div class="bg-red-200 p-5 rounded-md">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            {{-- type / rooms / beds / bathrooms --}}
            <div class="flex justify-between gap-5">

                <!-- type -->
                <div class="mb-3 w-full">
                    <x-input-label for="type" :value="__('Type *')" class="text-black"/>
                    <select name="type" id="type" class="block mt-1 rounded-md w-full border-gray-300">
                        <option value="House" {{ old('type') == 'House' ? 'selected' : '' }}>House</option>
                        <option value="Apartment" {{ old('type') == 'Apartment' ? 'selected' : '' }}>Apartment</option>
                        <option value="Hotel" {{ old('type') == 'Hotel' ? 'selected' : '' }}>Hotel</option>
                        <option value="GuestHouse" {{ old('type') == 'GuestHouse' ? 'selected' : '' }}>GuestHouse</option>
                    </select>
                    @error('type')
                        <div class="bg-red-200 p-5 rounded-md">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- rooms --}}
                <div class="mb-3 w-full">
                    <x-input-label for="rooms" :value="__('Bedrooms *')" class="text-black"/>
                    <input type="number" name="rooms" id="rooms" value="{{ old('rooms') ?? 1 }}"
                        class="block mt-1 rounded-md w-full border-gray-300
                        @error('rooms') is-invalid @enderror" min="1"
                        @required(true) />
                    @error('rooms')
                        <div class="bg-red-200 p-5 rounded-md">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- beds --}}
                <div class="mb-3 w-full">
                    <x-input-label for="beds" :value="__('Beds *')" class="text-black"/>
                    <input type="number" name="beds" id="beds"
                        class="block mt-1 rounded-md w-full border-gray-300
                        @error('beds') is-invalid @enderror"
                        value="{{ old('beds') ?? 1 }}" min="1" />
                    @error('beds')
                        <div class="bg-red-200 p-5 rounded-md">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- bathrooms --}}
                <div class="mb-3 w-full">
                    <x-input-label for="bathrooms" :value="__('Bathrooms *')" class="text-black"/>
                    <input type="number" name="bathrooms" id="bathrooms" value="{{ old('bathrooms') ?? 1 }}"
                        class="block mt-1 rounded-md w-full border-gray-300
                        @error('bathrooms') is-invalid @enderror"
                        min="1" />
                    @error('bathrooms')
                        <div class="bg-red-200 p-5 rounded-md">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            {{-- thumb --}}
            <div class="mb-3">
                <x-input-label for="thumb" :value="__('Thumbnail')" class="text-black"/>

                <label id="file-name-container" for="thumb" class="form-input rounded-md shadow-sm mt-1 block w-full border-gray-300 text-gray-500 @error('thumb') is-invalid @enderror">
                    Select file
                </label>

                <input class="form-control @error('thumb') is-invalid @enderror" type="file" id="thumb" accept=".jpeg, .png, .jpg" name="thumb">

                @error('thumb')
                    <div class="bg-red-200 p-5 rounded-md">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- prezzo notte --}}
            <div class="flex justify-between items-center gap-5">
                <div>
                    <x-input-label for="range" :value="__('Price per night *')" class="text-black"/>
                    <div id="price_display" class="block mt-1 w-full rounded-md bg-white p-2 border border-gray-300">
                        € {{ old('price_per_night') ? '€' . old('price_per_night') : '0' }}
                    </div>
                </div>

                <div class="flex-grow mr-5 mt-5">
                    <x-input-label for="price_per_night" :value="__('')" />

                    <input type="range" class="custom-range form-range w-full mt-2" min="0" max="500" step="10"
                        value="{{ old('price_per_night') ? old('price_per_night') : '0' }}" id="price_per_night"
                        name="price_per_night">
                    @error('price_per_night')
                        <div class="bg-red-200 p-5 rounded-md">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            {{-- service --}}
            <div class="my-5">
                <x-input-label for="range" :value="__('Services *')" class="text-black"/>
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

            {{-- <x-primary-button type="submit">Confirm</x-primary-button> --}}
            <x-button-gradient type="submit">
                <button class="uppercase">Confirm</button>
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
    var inputFile = document.getElementById('thumb');

    inputFile.addEventListener('change', function(){
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

    input[type="file"]{
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

{{-- <div>
    <div class="mb-3 bg-blue-500">
        <x-input-label for="title" :value="__('title')" />
        <input type="text" name="title" id="title" value="{{ old('title') }}"
            placeholder="Accommodation title"
            class="block mt-1 w-full
            @error('title') is-invalid @enderror" @required(true) />
        @error('title')
            <div class="bg-red-200">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="mb-3 bg-blue-500">
        <x-input-label for="type" :value="__('type')" />
        <select name="type" id="type" class="block mt-1 w-full">
            <option value="House" {{ old('type') == 'House' ? 'selected' : '' }}>House</option>
            <option value="Apartment" {{ old('type') == 'Apartment' ? 'selected' : '' }}>Apartment</option>
            <option value="Hotel" {{ old('type') == 'Hotel' ? 'selected' : '' }}>Hotel</option>
            <option value="GuestHouse" {{ old('type') == 'GuestHouse' ? 'selected' : '' }}>GuestHouse</option>
        </select>
        @error('type')
            <div class="bg-red-200">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="mb-3 bg-blue-500">
        <x-input-label for="rooms" :value="__('rooms')" />
        <input type="number" name="rooms" id="rooms" value="{{ old('rooms') ?? 1 }}"
            class="form-control
            @error('rooms') is-invalid @enderror" min="1"
            @required(true) />
        @error('rooms')
            <div class="bg-red-200">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="mb-3 bg-blue-500">
        <x-input-label for="beds" :value="__('beds')" />
        <input type="number" name="beds" id="beds"
            class="form-control
            @error('beds') is-invalid @enderror"
            value="{{ old('beds') ?? 1 }}" min="1" />
        @error('beds')
            <div class="bg-red-200">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="mb-3 bg-blue-500">
        <x-input-label for="bathrooms" :value="__('bathrooms')" />
        <input type="number" name="bathrooms" id="bathrooms" value="{{ old('bathrooms') ?? 1 }}"
            class="form-control
            @error('bathrooms') is-invalid @enderror"
            min="1" />
        @error('bathrooms')
            <div class="bg-red-200">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="w-50 address-input-group mb-3 bg-blue-500">
        <x-input-label for="address" :value="__('address')" />
        <input type="text" name="address" id="address" placeholder="Your address here"
            class="form-control
            @error('address') is-invalid @enderror"
            @required(true) value="{{ old('address') }}" autocomplete="off" />
        @error('address')
            <div class="bg-red-200">
                {{ $message }}
            </div>
        @enderror
        <ul class="dropdown-menu-dark w-full" id="create-dropdown">
        </ul>
        <input type="hidden" name="selected_address" id="selected_address">
    </div>

    <div class="mb-3 bg-blue-500">
        <x-input-label for="city" :value="__('city')" />
        <input type="text" name="city" id="city" placeholder="Your city here" @required(true)
            value="{{ old('city') }}"
            class="form-control
            @error('city') is-invalid @enderror" />
        @error('city')
            <div class="bg-red-200">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="mb-3 bg-blue-500">
        <x-input-label for="price_per_night" :value="__('price_per_night')" />
        <input type="range" class="form-range" min="0" max="500" step="10"
            value="{{ old('price_per_night') ? old('price_per_night') : '0' }}" id="price_per_night"
            name="price_per_night">
        <div id="price_display">Price: {{ old('price_per_night') ? '€' . old('price_per_night') : '0' }}
        </div>
        @error('price_per_night')
            <div class="bg-red-200">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="mb-3">
        <x-input-label for="thumb" :value="__('thumb')" />

        <input class="form-control @error('thumb') is-invalid @enderror" type="file" id="thumb"
            name="thumb">
        @error('thumb')
            <div class="bg-red-200">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="my-5">
        <h5 class="mb-3">
            What services does your accommodation offer?
        </h5>
        <div class="mb-3 flex flex-wrap">
            @foreach ($services as $service)
                <div class="my-3 me-3">
                    <input type="checkbox" name="services[]" id="service_{{ $service->id }}"
                        value="{{ $service->id }}" class="form-checkbox h-5 w-5 text-blue-500"
                        {{ in_array($service->id, old('services', [])) ? 'checked' : '' }}>
                    <label for="service_{{ $service->id }}"
                        class="ml-2 text-sm text-gray-700">{{ $service->name }}</label>
                </div>
            @endforeach
        </div>
    </div>

</div> --}}
