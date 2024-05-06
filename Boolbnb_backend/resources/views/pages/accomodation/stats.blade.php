<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="h-screen border">
        @if ($accomodations !== null && count($accomodations) > 0)
            <div class="subtitle flex justify-between m-5">
                <h2 class="title">Statistics (Total accommodations: {{ $accomodations->total() }})</h2>
            </div>

            <div class="flex flex-wrap justify-start gap-5 px-5">
                @foreach ($accomodations as $item)
                    <div class="cards max-w-sm rounded overflow-hidden shadow-lg">
                        <img class="w-full" src="{{ asset($item->thumb) }}" style="height: 200px"
                            alt="{{ $item->title }}">
                        <div class="px-6 py-4">
                            <div class="font-bold text-xl mb-2">{{ $item->title }}</div>
                        </div>
                        <div class="px-6 pt-4">
                            <span
                                class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ $item->rating ?? 'No rating' }}</span>
                            <span
                                class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ $item->price_per_night }}
                                € per night</span>

                            <div class="flex items-center gap-2">

                                <span
                                    class=" bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2 flex items-center gap-2">
                                    <img src="{{ asset('icons/message-square.svg') }}" alt="Map Icon">
                                    <span>
                                        {{ $item->views()->count() }} views
                                    </span>


                                </span>

                                <span
                                    class=" bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2 flex items-center gap-2">
                                    <img src="{{ asset('icons/Map.svg') }}" alt="Map Icon">
                                    <span>
                                        {{ $item->messages()->count() }} messages
                                    </span>




                                </span>
                            </div>


                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-5 mx-10">
                {{ $accomodations->links() }}
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

    main>* {
        width: 100%;
    }

    .cards {
        flex: 1 1 calc(20% - 1rem);
        max-width: calc(20% - 1rem);
    }

    @media (max-width: 768px) {
        .cards {
            flex: 1 1 calc(100% - 1rem);
            max-width: calc(100% - 1rem);
        }
    }

    .info {
        justify-content: center;
        align-items: center;
    }
</style>
