<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <img src="{{ asset('storage/uploads/' . $user->user_propic) }}" id="propic">
    </x-slot>

    <div class="flex h-screen border">
        <div class="w-full ">
            @if ($accomodations !== null && count($accomodations) > 0)
                <div class="subtitle flex justify-between m-5">
                    <a href="{{ route('accomodations.archive') }}">
                        <h2 class="title">Your Accommodations ({{ $accomodations->count() }})</h2>
                    </a>

                    <x-button-gradient class="gradient-button">
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
                                <tr class="border-b hover:bg-neutral-100 {{ $item->hidden ? 'text-gray-600' : '' }}">
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
                                    <td class="px-6 py-5">{{ $item->type }}</td>
                                    <td class="px-6 py-5">{{ $item->address }}</td>
                                    {{-- <td class="px-6 py-5">{{ $item->city }}</td> --}}
                                    <td class="px-6 py-5">{{ $item->price_per_night }} €</td>
                                    <td class="border px-4 py-2">
                                        <div class="flex gap-2 justify-around">
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

                    <nav class="mt-5 flex items-center justify-between text-sm ml-5 mr-5"
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
                </div>
                
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
</x-app-layout>

<style>
    /* Rules to fix the sidebar and right side dimensions */
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
</style>
