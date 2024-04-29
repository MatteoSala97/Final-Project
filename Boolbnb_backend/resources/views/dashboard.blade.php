<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <img src="{{ asset('storage/uploads/' . $user->user_propic) }}" id="propic">
    </x-slot>

    <div class="flex h-screen border">

        {{-- Accommodations / Stats / Advertisement / Messages / Logout --}}
        {{-- <div class="sidebar flex flex-col pt-4 px-5">
            <div class="flex flex-col gap-4">

                <div class="sidebar-item">
                    <a href="#" class="flex items-center text-left hover:text-white">
                        <img src="/icons/home-alt.svg" class="mr-1" alt="Home">
                        <span>Accommodations</span>
                    </a>
                </div>
                <div class="sidebar-item">
                    <a href="#" class="flex text-left hover:text-white">
                        <img src="/icons/graph-bar.svg" class="mr-1" alt="">
                        <span>Stats</span>
                    </a>
                </div>
                <div class="sidebar-item">
                    <a href="#" class="flex items-center text-left hover:text-white">
                        <img src="/icons/rocket.svg" class="mr-1" alt="">
                        <span>Advertisement</span>
                    </a>
                </div>
                <div class="sidebar-item">
                    <a href="#" class="flex items-center text-left hover:text-white">
                        <img src="/icons/message-square.svg" class="mr-1" alt="">
                        <span>Messages</span>
                    </a>
                </div>

            </div>

            <div class="sidebar-item mt-auto mb-4">
                <a href="#" class="flex items-center text-left">
                    <img src="/icons/user.svg" class="mr-2" alt="">
                    <span>Logout</span>
                </a>
            </div>
        </div> --}}

        <div class="w-full border ">
            @if($accomodations !== null && count($accomodations) > 0)
                <div class="subtitle flex justify-between m-5">
                    <h2 class="title">Your Accommodations ({{ $accomodations->count() }})</h2>

                    <x-button-gradient>
                        <a href="{{ route('dashboard.accomodations.create') }}">
                            {{ __('Create a new accommodation') }}
                        </a>
                    </x-button-gradient>

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
                                <th scope="col" class="px-6 py-5">
                                    Type
                                </th>
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
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <!-- Table body -->
                        <tbody>
                            @foreach ($accomodations as $item)
                            <tr class="border-b hover:bg-neutral-100">
                                <th scope="row" class="px-6 py-5" style="height: 80px">
                                    @if ( $item->thumb )
                                        <img src="{{ asset('storage/uploads/' . $item->thumb) }}" style="height: 80px "
                                        id="old_thumb">
                                    @else
                                        <span >
                                            {{ $item->id }}
                                        </span>
                                    @endif
                                </th>
                                <td class="px-6 py-5">{{ $item->title }}</td>
                                <td class="px-6 py-5">{{ $item->type }}</td>
                                <td class="px-6 py-5">{{ $item->address }}</td>
                                {{-- <td class="px-6 py-5">{{ $item->city }}</td> --}}
                                <td class="px-6 py-5">{{ $item->price_per_night }} €</td>
                                <td class="border px-4 py-2">
                                    <div class="flex gap-2 justify-around">
                                        <a href="{{ route('dashboard.accomodations.show', $item->id) }}"
                                            class="btn btn-gray py-1">
                                            <img src="{{ asset('icons/eye.svg') }}" alt="Show button">
                                        </a>
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

                    {{-- //TODO - Aggiungere la logica di navigazione tra le pagine --}}

                    <nav class="mt-5 flex items-center justify-between text-sm ml-5 mr-5" aria-label="Page navigation example">
                        <p>
                            Showing <strong>1-5</strong> of <strong>10</strong>
                        </p>

                        <ul class="list-style-none flex">
                            <li>
                                <a class="relative block rounded bg-transparent px-3 py-1.5 text-sm text-neutral-600 transition-all duration-300" href="#!">
                                    Previous
                                </a>
                            </li>
                            <li>
                                <a class="relative block rounded bg-transparent px-3 py-1.5 text-sm text-neutral-600 transition-all duration-300" href="#!">
                                    1
                                </a>
                            </li>
                            <li aria-current="page">
                                <a class="relative block rounded bg-blue-100 px-3 py-1.5 text-sm font-medium text-blue-700 transition-all duration-300" href="#!">
                                    2
                                    <span class="absolute -m-px h-px w-px overflow-hidden whitespace-nowrap border-0 p-0 [clip:rect(0,0,0,0)]">
                                        (current)
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a class="relative block rounded bg-transparent px-3 py-1.5 text-sm text-neutral-600 transition-all duration-300 hover:bg-neutral-100" href="#!">
                                    3
                                </a>
                            </li>
                            <li>
                                <a class="relative block rounded bg-transparent px-3 py-1.5 text-sm text-neutral-600 transition-all duration-300 hover:bg-neutral-100" href="#!">
                                    Next
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            @else
                <div class="info flex flex-col justify-center items-center h-screen text-grey gap-5">
                    <p>
                        There are no accommodations, please start by adding a new one.
                    </p>

                    <x-button-gradient>
                        <a href="{{ route('dashboard.accomodations.create') }}">
                            Add accommodation
                        </a>
                    </x-button-gradient>

                </div>
            @endif
        </div>
    </div>
</x-app-layout>

<style>
    #propic {
        position: absolute;
        right: 16%;
        top: 2%;
        clip-path: circle();
        width: 55px;
    }
    .sidebar {
        height: calc(90vh - 0vh);
    }
    .sidebar-item {
        padding: 10px 30px 10px 10px;
        font-size: 18px;
        font-weight: bold;
    }
    .sidebar-item:hover {
        color: white;
        background-color: #000000;
        border-radius: 20px;
    }
    .sidebar-item:hover img {
        filter: invert(1);
    }
    .sidebar-item img {
        width: 20px;
        height: 20px;
    }
    .title {
        font-size: 1.5rem;
        font-weight: bold;
    }




    /* .ciaoooo{
        height: calc(100vh - 0);
        background-color: green;
    }

    .ciaoooooo2{
        height: calc(100vh - 0);
        background-color: blue;
    } */





    /* .gradient-button {
        background-image: linear-gradient(135deg, #00CBD8, #B844FF);
        border: none;
        color: white;
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 10px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .gradient-button:hover {
        background-image: linear-gradient(135deg, #00A9BF, #A336DF);
    } */
</style>
