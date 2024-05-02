<x-app-layout>
    <div class="container w-full">

        <div class="my-5 flex gap-5 items-center ml-4">
            {{-- <a href="{{ route('dashboard') }}" class="flex items-center">
                <x-arrowleft/>
            </a> --}}
            <p class="font-bold text-xl">Advertisement</p>
        </div>

        {{-- <form class="ms-4" action="" method="POST" enctype="multipart/form-data"> @csrf --}}

        <div class=" flex justify-between gap-4 mb-4" style="">
            <div class="ads border border-gray-200 rounded-xl flex gap-3 p-6 w-2/6 cursor-pointer active" id="12">
                <x-silver_svg class="pointer-events-none" />
                <div class="flex-1 flex flex-col justify-between pointer-events-none">
                    <div class="text-left">
                        <h1 class="title">Silver</h1>
                        <p class="">€2,99 for 24 hours</p>
                    </div>
                </div>
            </div>

            <div class="ads border border-gray-200 rounded-xl flex gap-3 p-6 w-2/6 cursor-pointer" id="13">
                <x-gold_svg class="pointer-events-none" />
                <div class="flex-1 flex flex-col justify-between pointer-events-none">
                    <div class="text-left">
                        <h1 class="title">Gold</h1>
                        <p class="">€5,99 for 72 hours</p>
                    </div>
                </div>
            </div>

            <div class="ads border border-gray-200 rounded-xl flex gap-3 p-6 w-2/6 cursor-pointer" id="14">
                <x-platinum_svg class="pointer-events-none" />
                <div class="flex-1 flex flex-col justify-between pointer-events-none">
                    <div class="text-left">
                        <h1 class="title">Platinum</h1>
                        <p class="">€9,99 for 144 hours</p>
                    </div>
                </div>
            </div>
        </div>

        <div class=" border-gray-200 rounded-xl flex justify-center mt-4  h-screen border w-full">
            {{-- <div class="flex flex-col justify-center items-center">
                    <p class="text-center">There are no advertised accommodations with this package</p>
                    <div class="mt-4">
                        <x-button-gradient type="submit" class="gradient-button">
                            <button class="uppercase">Advertise an accommodation</button>
                        </x-button-gradient>
                    </div>
                </div> --}}

            <div class="w-full ">
                @if ($accomodations !== null && count($accomodations) > 0)
                    <div class="subtitle flex justify-between m-5">
                        <h2 class="title">Your Accommodations ({{ $accomodations->count() }})</h2>

                        {{-- <x-button-gradient class="gradient-button">
                            <a href="{{ route('dashboard.accomodations.create') }}">
                                {{ __('Create a new accommodation') }}
                            </a>
                        </x-button-gradient> --}}

                    </div>

                    <!-- Table responsive wrapper -->
                    <div class="overflow-x-auto bg-white">
                        <!-- Table -->
                        <table class="min-w-full text-left text-sm whitespace-nowrap">
                            <!-- Table head -->
                            <thead class="uppercase tracking-wider border-b-2">
                                <tr>
                                    <th scope="col" class="px-6 py-5">
                                        Thumbnail Image or id
                                    </th>
                                    <th scope="col" class="px-6 py-5">
                                        Title
                                    </th>
                                    {{-- <th scope="col" class="px-6 py-5">
                                        Type
                                    </th> --}}
                                    <th scope="col" class="px-6 py-5">
                                        Address
                                    </th>
                                    {{-- <th scope="col" class="px-6 py-5">
                                            City
                                        </th> --}}
                                    <th scope="col" class="px-6 py-5">
                                        Price per night
                                    </th>
                                    <th scope="col" class="px-6 py-5">
                                        AD HOURS LEFT
                                    </th>
                                    <th scope="col" class="px-6 py-5">
                                        Advertise
                                    </th>
                                </tr>
                            </thead>
                            <!-- Table body -->
                            <tbody>
                                @foreach ($accomodations as $item)
                                    <tr
                                        class="border-b hover:bg-neutral-100 {{ $item->hidden ? 'text-gray-600' : '' }}">
                                        <th scope="row" class="px-6 py-5" style="height: 80px">
                                            @if ($item->thumb)
                                                <img src="{{ asset('storage/uploads/' . $item->thumb) }}"
                                                    style="height: 80px" class="{{ $item->hidden ? 'grayscale' : '' }}"
                                                    id="old_thumb">
                                            @else
                                                <span>
                                                    {{ $item->id }}
                                                </span>
                                            @endif
                                        </th>
                                        <td class="px-6 py-5">{{ $item->title }}</td>
                                        {{-- <td class="px-6 py-5">{{ $item->type }}</td> --}}

                                        <td class="px-6 py-5">{{ $item->address }}</td>
                                        {{-- <td class="px-6 py-5">{{ $item->city }}</td> --}}
                                        <td class="px-6 py-5">{{ $item->price_per_night }} €</td>
                                        <td class="px-6 py-5">
                                            @if ($item->ads->isNotEmpty())
                                                @php
                                                    $totalDuration = $item->ads->sum('duration') * 24;
                                                    $latestExpiration = $item->ads->max(function ($ad) {
                                                        return $ad->pivot->expiration_date
                                                            ? Carbon\Carbon::parse($ad->pivot->expiration_date)
                                                            : null;
                                                    });
                                                @endphp

                                                {{ $latestExpiration->format('d-m-Y H:i') }}
                                            @else
                                                Not Advertised
                                            @endif
                                        </td>
                                        <td class="border px-4 py-2">
                                            <div class="flex gap-2 justify-around">
                                                <x-button-gradient class="gradient-button ">
                                                    <button class="uppercase ad-button"
                                                        data-accommodation-id="{{ $item->id }}">Advertise</button>
                                                </x-button-gradient>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{-- //TODO - Aggiungere la logica di navigazione tra le pagine --}}

                        {{-- <nav class="mt-5 flex items-center justify-between text-sm ml-5 mr-5"
                                aria-label="Page navigation example">
                                <p>
                                    Showing <strong>1-5</strong> of <strong>10</strong>
                                </p>
        
                                <ul class="list-style-none flex">
                                    <li>
                                        <a class="relative block rounded bg-transparent px-3 py-1.5 text-sm text-neutral-600 transition-all duration-300"
                                            href="#!">
                                            Previous
                                        </a>
                                    </li>
                                    <li>
                                        <a class="relative block rounded bg-transparent px-3 py-1.5 text-sm text-neutral-600 transition-all duration-300"
                                            href="#!">
                                            1
                                        </a>
                                    </li>
                                    <li aria-current="page">
                                        <a class="relative block rounded bg-blue-100 px-3 py-1.5 text-sm font-medium text-blue-700 transition-all duration-300"
                                            href="#!">
                                            2
                                            <span
                                                class="absolute -m-px h-px w-px overflow-hidden whitespace-nowrap border-0 p-0 [clip:rect(0,0,0,0)]">
                                                (current)
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="relative block rounded bg-transparent px-3 py-1.5 text-sm text-neutral-600 transition-all duration-300 hover:bg-neutral-100"
                                            href="#!">
                                            3
                                        </a>
                                    </li>
                                    <li>
                                        <a class="relative block rounded bg-transparent px-3 py-1.5 text-sm text-neutral-600 transition-all duration-300 hover:bg-neutral-100"
                                            href="#!">
                                            Next
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div> --}}
                    @else
                        <div class="info flex flex-col justify-center items-center h-screen text-grey gap-5">
                            <p>
                                There are no accommodations, please start by adding a new one.
                            </p>

                            <x-button-gradient class="gradient-button">
                                <a href="{{ route('dashboard.accomodations.create') }}">
                                    Add accommodation
                                </a>
                            </x-button-gradient>

                        </div>
                @endif
            </div>
        </div>



        {{-- </form> --}}
        <form id="payment-form" action="{{ route('dashboard.payment.process') }}" method="post" class="hidden">
            @csrf
            <div id="dropin-container"></div>
            <input type="hidden" id="accommodation_id" name="accommodation_id">
            <input type="hidden" id="selected_plan_id" name="selected_plan_id" value="12">
            <input type="submit" value="Purchase" class="gradient-button">
            <input type="hidden" id="nonce" name="payment_method_nonce" />
        </form>

    </div>
</x-app-layout>
<script>
    // 4111111111111111	test card
    const button = document.querySelector('#submit-button');
    const client_token = "{{ $token }}";
    const sandbox_token = "{{ $tokenization_key }}"
    const form = document.getElementById('payment-form');
    const hidden_id_input = document.getElementById('accommodation_id');
    const hidden_selected_plan_input = document.getElementById('selected_plan_id');
    const ad_buttons = document.querySelectorAll('.ad-button');
    let ads_plan_buttons = document.querySelectorAll('.ads')
    let active_ad = 'silver'


    ads_plan_buttons.forEach((button) => {
        button.addEventListener('click', (e) => {
            ads_plan_buttons.forEach((button) => {
                button.classList.remove('active')
            })
            e.target.classList.add('active')
            hidden_selected_plan_input.value = Number(e.target.id)
        })
    })

    ad_buttons.forEach((button) => {
        button.addEventListener('click', (event) => {
            console.log(event.target)
            console.log(event.target.dataset.accommodationId)
            const accommodationId = event.target.dataset.accommodationId;
            hidden_id_input.value = accommodationId;
            form.classList.remove('hidden')
        })
    })


    braintree.dropin.create({
        authorization: client_token,
        container: '#dropin-container'
    }, (error, dropinInstance) => {
        if (error) console.error(error);

        form.addEventListener('submit', event => {
            event.preventDefault();

            dropinInstance.requestPaymentMethod((error, payload) => {
                if (error) console.error(error);


                document.getElementById('nonce').value = payload.nonce;
                form.submit();
            });
        });
    });
</script>

<style>
    /* Rules to fix the sidebar and right side dimensions */
    .ads:hover,
    .ads.active {
        border: 1px solid black;
    }

    html,
    body {
        height: 100%;
    }


    .min-h-screen {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }


    main {
        flex: 1;
    }

    main>* {
        width: 100%;
    }

    /* #dropin-container {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    } */

    .button {
        cursor: pointer;
        font-weight: 500;
        left: 3px;
        line-height: inherit;
        position: relative;
        text-decoration: none;
        text-align: center;
        border-style: solid;
        border-width: 1px;
        border-radius: 3px;
        -webkit-appearance: none;
        -moz-appearance: none;
        display: inline-block;
    }

    .button--small {
        padding: 10px 20px;
        font-size: 0.875rem;
    }

    .button--green {
        outline: none;
        background-color: #64d18a;
        border-color: #64d18a;
        color: white;
        transition: all 200ms ease;
    }

    .button--green:hover {
        background-color: #8bdda8;
        color: white;
    }
</style>
