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
                <div class="subtitle flex justify-between m-5">
                    <a href="{{ route('accomodations.archive') }}">
                        <h2 class="title">Your Accommodations ({{ $accomodations->total() }})</h2>
                    </a>

                    <a href="{{ route('dashboard.accomodations.create') }}">
                        <x-button-gradient>
                            {{ __('Create a new accommodation') }}
                        </x-button-gradient>
                    </a>
                </div>

                <!-- Table responsive wrapper -->
                <div class="overflow-x-auto">
                    <!-- Table -->
                    <table class="min-w-full text-left text-sm whitespace-nowrap">
                        <!-- Table head -->
                        <thead class="uppercase tracking-wider border border-x-0">
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
                                <tr class="border border-x-0 hover:bg-neutral-100 {{ $item->hidden ? 'text-gray-600' : '' }}">
                                    <th scope="row" class="px-6 py-5" style="height: 80px">
                                        @if ($item->thumb)
                                            <img src="{{ asset($item->thumb) }}" style="height: 80px"
                                                class="{{ $item->hidden ? 'grayscale' : '' }}" id="old_thumb">
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
                                    <td class="border border-x-0 px-4 py-2">
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

                    <div class="mt-5 mx-10">
                        {{ $accomodations->links() }}
                    </div>


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
