<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="h-screen border">
        @if ($accomodations !== null && count($accomodations) > 0)
        <div class="subtitle flex justify-between m-5">
            <h2 class="title">Statistics</h2>
        </div>

            <div class="flex flex-wrap justify-start gap-4 p-5">
                @foreach ($accomodations as $item)
                    <div class="cards max-w-sm rounded overflow-hidden shadow-lg">
                        <img class="w-full" src="{{ asset('storage/uploads/' . $item->thumb) }}" style="height: 200px" alt="{{ $item->title }}">
                        <div class="px-6 py-4">
                            <div class="font-bold text-xl mb-2">{{ $item->title }}</div>
                        </div>
                        <div class="px-6 pt-4 pb-2">
                            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ $item->rating?? 'No rating' }}</span>
                            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ $item->price_per_night }} € per night</span>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="info flex flex-col justify-center items-center h-screen text-grey gap-5">
                <p>
                    There are no accommodations, please start by adding a new one.
                </p>


                <a href="{{ route('dashboard.accomodations.create') }}">
                    <x-button-gradient>
                        Add accommodation
                    </x-button-gradient>
                </a>


            </div>
        @endif
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

    main > * {
        width: 100%;
    }

    .cards {
        flex: 0 0 calc(25% - 1rem); /* Set width of each card */
    }

    @media (max-width: 768px) {
        .cards {
            flex: 0 0 calc(50% - 1rem); /* Set width of each card on smaller screens */
        }
    }

    .info {
        justify-content: center;
        align-items: center;
    }
</style>
