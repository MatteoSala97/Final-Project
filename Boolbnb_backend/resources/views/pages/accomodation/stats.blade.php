<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="h-full mb-4">
        @if ($accomodations !== null && count($accomodations) > 0)
            <div class="subtitle flex justify-between m-5">
                <h2 class="font-bold text-xl ml-4">Statistics (Total accommodations: {{ $accomodations->total() }})</h2>
            </div>

            <div class="flex flex-wrap gap-5 px-4">
                @foreach ($accomodations as $item)
                    <div class="cards rounded overflow-hidden shadow-lg w-2/6 pointer"
                        onclick="window.location='{{ route('accomodations.show-stats', ['accomodation' => $item->id]) }}';">
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
                                € per night
                            </span>

                            <div class="flex items-center gap-2">

                                <span
                                    class=" bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2 flex items-center gap-2 ">
                                    <img src="{{ asset('icons/Map.svg') }}" alt="Views Icon">
                                    <span class="">
                                        {{ $item->views()->count() }}
                                        <span class="hide-me">
                                            views
                                        </span>
                                    </span>


                                </span>

                                <span
                                    class=" bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2 flex items-center gap-2 ">
                                    <img src="{{ asset('icons/message-square.svg') }}" alt="Messages Icon">

                                    <span class="">
                                        {{ $item->messages()->count() }}
                                        <span class="hide-me">
                                            messages
                                        </span>
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
    @media screen and (min-width: 1024px) {
        .cards {
            width: calc(20% - 1rem);
            margin: 0 auto;
        }
    }

    @media screen and (max-width: 1023px) {
        .cards {
            width: calc(33.33% - 1rem);
        }
    }

    @media screen and (max-width: 834px) {
        .cards {
            width: calc(50% - 1rem);
        }

        .hide-me {
            display: none;
        }

    }

    @media screen and (max-width: 640px) {
        .cards {
            width: calc(100% - 1rem);
        }
    }


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

    /* .cards {
        flex: 1 1 calc(20% - 1rem);
        max-width: calc(20% - 1rem);
    } */


    .info {
        justify-content: center;
        align-items: center;
    }
</style>
