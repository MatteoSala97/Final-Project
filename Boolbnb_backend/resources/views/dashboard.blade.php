<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <img src="{{ asset('storage/uploads/' . $user->user_propic) }}" id="propic">
    </x-slot>

    <div class="flex w-full">
        <div class="w-full mx-4">
            @if ($accomodations !== null && count($accomodations) > 0)
                <div id="create-accom" class="subtitle flex justify-between m-5">
                    <a href="{{ route('accomodations.archive') }}">
                        <p class="font-bold text-xl">Your Accommodations ({{ $accomodations->count() }})</p>
                    </a>

                    <a class="create-lg" href="{{ route('dashboard.accomodations.create') }}">
                        <x-button-gradient>
                            {{ __('Create a new accommodation') }}
                        </x-button-gradient>
                    </a>

                    <a class="create-sm" href="{{ route('dashboard.accomodations.create') }}">
                        <x-button-gradient>
                            {{ __('Create') }}
                        </x-button-gradient>
                    </a>

                </div>


                <!-- Table responsive wrapper -->
                <div class="overflow-x-auto h-screen">
                    <!-- Table -->
                    <table class="min-w-full text-left text-sm whitespace-nowrap">
                        <!-- Table head -->
                        <thead class="uppercase tracking-wider border border-x-0">
                            <tr>
                                <th scope="col" class="px-6 py-5 th-id">
                                    Thumbnail Image or id
                                </th>
                                <th scope="col" class="px-6 py-5 th-title">
                                    Title
                                </th>
                                <th scope="col" class="px-6 py-5 th-type">
                                    Type
                                </th>
                                <th scope="col" class="px-6 py-5 th-address">
                                    Address
                                </th>
                                {{-- <th scope="col" class="px-6 py-5">
                                    City
                                </th> --}}
                                <th scope="col" class="px-6 py-5 th-price_per_night">
                                    Price per night
                                </th>
                                <th scope="col" class="px-6 py-5 th-btn">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <!-- Table body -->

                        {{-- <tr class="border border-x-0 hover:bg-neutral-100 message-row view-message-btn cursor-pointer"
                        data-message-id="{{ $message->id }}"
                        onclick="window.location='{{ route('messages.show', ['message' => $message->id]) }}';"> --}}

                        <tbody>
                            @foreach ($accomodations as $item)
                                <tr class="border border-x-0 hover:bg-neutral-100{{ $item->hidden ? 'text-gray-600' : '' }}">
                                    <td scope="row" class="px-6 py-5 td-id" style="height: 80px">
                                        @if ($item->thumb)
                                            <img src="{{ asset($item->thumb) }}" style="height: 80px; width: 110px;"
                                                class="{{ $item->hidden ? 'grayscale' : '' }}" id="old_thumb">
                                        @else
                                            <span>
                                                {{ $item->id }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="td-title px-6 py-5">
                                        <a class="cursor-pointer underline text-blue-500" href="{{ route('dashboard.accomodations.show', ['accomodation' => $item->id]) }}">
                                            {{ $item->title }}
                                        </a>
                                    </td>
                                    <td class="td-type px-6 py-5">{{ $item->type }}</td>
                                    <td class="td-address px-6 py-5">{{ $item->address }}</td>
                                    {{-- <td class="px-6 py-5">{{ $item->city }}</td> --}}
                                    <td class="td-price_per_night px-6 py-5">{{ $item->price_per_night }} €</td>
                                    <td class=" px-4 py-2">
                                        <div class="td-btn flex gap-5">
                                            <form
                                                action="{{ route('dashboard.accomodations.changeVisibility', $item->id) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-gray py-1">
                                                    @if (!$item->hidden)
                                                        <img src="{{ asset('icons/eye.svg') }}" alt="Show button">
                                                    @else
                                                        <img src="{{ asset('icons/eye-slashed.svg') }}"
                                                            alt="Show button">
                                                    @endif
                                                </button>
                                            </form>

                                            <a href="{{ route('dashboard.accomodations.edit', $item->id) }}"
                                                class="btn btn-yellow py-1">
                                                <img src="{{ asset('icons/pencil.svg') }}" alt="Edit button">
                                            </a>

                                            <form method="POST"
                                                action="{{ route('dashboard.accomodations.destroy', $item->id) }}">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-red py-1">
                                                    <img src="{{ asset('icons/trashcan.svg') }}" alt="Delete">
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-5 mx-10">
                        {{ $accomodations->links() }}
                    </div>


                </div>
            @else
                <div class="info flex flex-col justify-center items-center h-screen text-grey  gap-5">
                    <p>
                        There are no accommodations, please start by adding a new one.
                    </p>

                    <a href="{{ route('dashboard.accomodations.create') }}">
                        <x-button-gradient >
                            Add accommodation
                        </x-button-gradient>
                    </a>



                </div>
            @endif

        </div>
    </div>
</x-app-layout>

<style>
    .th-id, .td-id,
    .th-title, .td-title,
    .th-type, .td-type,
    .th-address, .td-address,
    .th-price_per_night, .td-price_per_night,
    .th-btn, .td-btn{
        max-width: 200px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .th-price_per_night, .td-price_per_night{
        max-width: 140px;
    }

    @media screen and (max-width: 1240px){
        .th-id, .td-id{
            max-width: 150px;
        }
        .th-address, .td-address{
            max-width: 150px;
        }
    }

    @media screen and (max-width: 1140px){
        .td-type, .th-type{
            display: none;
        }
        .th-address, .td-address{
            max-width: 140px;
        }
        .th-price_per_night, .td-price_per_night{
            max-width: 100px;
        }
    }

    @media screen and (max-width: 1000px){
        .th-id, .td-id,
        .th-title, .td-title,
        .th-type, .td-type,
        .th-address, .td-address,
        .th-price_per_night, .td-price_per_night,
        .th-btn, .td-btn{
            padding-top: 10px;
            padding-bottom: 10px;
        }
        .th-title, .td-title{
            padding: 0px;
        }

        .th-id, .td-id{
            padding: 5px;
        }

        .th-price_per_night{
            max-width: 110px;
        }
        .th-id, .td-id{
            max-width: 110px;
        }
        #create-accom{
            flex-direction: column-reverse;
            text-align: center;
        }
        .td-price_per_night, .th-price_per_night{
            display: none;
        }
        .font-bold{
            font-size: 15px;
        }

    }

    @media screen and (max-width: 900px){
        .th-title, .td-title{
            max-width: 80px;
        }
        .th-address, .td-address{
            max-width: 90px;
        }
    }

    @media screen and (max-width: 810px){
        .th-address, .td-address{
            max-width: 100px;
        }
    }

    @media screen and (min-width: 769px){
        .create-lg{
            display: block;
        }
        .create-sm{
            display: none;
        }
    }

    @media screen and (max-width: 768px){
        .td-id, .th-id{
            display: none;
        }
        .create-lg{
            display: none;

        }
        .create-sm{
            display: block;
        }
    }

    @media screen and (max-width: 460px){
        .th-address, .td-address{
            display: none;
        }
    }


</style>
