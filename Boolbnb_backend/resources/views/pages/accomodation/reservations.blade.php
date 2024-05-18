<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="h-full">

        <h2 class="font-bold text-xl p-5 ml-4">Reservations ({{ $reservations->total() }})</h2>
        <!-- Table responsive wrapper -->
        <div class="tabella overflow-x-auto bg-white mx-4">

            <!-- Table -->
            <table class="min-w-full text-left text-sm whitespace-nowrap">

                <!-- Table head -->
                <thead class="uppercase tracking-wider border border-x-0">
                    <tr>
                        <th scope="col" class="px-6 py-5 th-id">
                            Thumbnail Image or id
                        </th>
                        <th scope="col" class="px-6 py-5 th-title">
                            Accommodation
                        </th>
                        <th scope="col" class="px-6 py-5 th-name">
                            Reserved by
                        </th>
                        <th scope="col" class="px-6 py-5 th-content">
                            Start Date
                        </th>
                        <th scope="col" class="px-6 py-5 th-created_at">
                            End Date
                        </th>
                        <th scope="col" class="px-6 py-5 th-created_at">
                            Booking date
                        </th>
                    </tr>
                </thead>

                <!-- Table body -->
                <tbody>
                    @foreach ($reservations as $reservation)
                        <tr class="border border-x-0 hover:bg-neutral-100 reservation-row view-reservation-btn">
                            <td class="px-6 py-5 td-title">
                                <img src="{{ asset($reservation->accommodation->thumb) }}"
                                    alt="{{ $reservation->accommodation->name }}"
                                    class="w-32 object-cover  aspect-auto">
                            </td>
                            <td class="px-6 py-5 td-title">{{ $reservation->accommodation->title }}</td>
                            <td class="px-6 py-5 td-name">{{ $reservation->guest->name }}
                                {{ $reservation->guest->surname }}</td>
                            <td class="px-6 py-5 td-content">{{ $reservation->start_date }}</td>
                            <td class="px-6 py-5 td-content">{{ $reservation->end_date }}</td>
                            <td class="px-6 py-5 td-created_at">{{ $reservation->created_at->format('Y-m-d') }}</td>
                        </tr>
                    @endforeach
                </tbody>




            </table>
            <div class="mt-5 mx-10">
                {{ $reservations->links() }}
            </div>

        </div>
    </div>
</x-app-layout>




<style>
    .th-id,
    .td-id,
    .th-title,
    .td-title,
    .th-name,
    .td-name,
    .th-content,
    .td-content,
    .th-created_at,
    .td-created_at {
        max-width: 200px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }


    @media screen and (max-width: 1240px) {

        .th-content,
        .td-content,
        .th-title,
        .td-title {
            max-width: 150px;
        }
    }

    @media screen and (max-width: 1140px) {

        .th-title,
        .td-title,
        .th-name,
        .td-name,
        .th-content,
        .td-content,
        .th-created_at,
        .td-created_at {
            max-width: 120px;
        }
    }

    @media screen and (max-width: 1000px) {

        .th-created_at,
        .td-created_at {
            display: none;
        }

    }

    @media screen and (max-width: 900px) {

        .th-id,
        .td-id {
            display: none;
        }
    }

    @media screen and (max-width: 768px) {

        .th-id,
        .td-id,
        .th-title,
        .td-title,
        .th-name,
        .td-name,
        .th-content,
        .td-content,
        .th-created_at,
        .td-created_at {
            padding-top: 10px;
            padding-bottom: 10px;
        }

    }

    @media screen and (max-width: 500px) {

        .th-content,
        .td-content {
            display: none;
        }

        .font-bold {
            font-size: 15px;
        }

    }

    @media screen and (max-width: 400px) {

        .th-name,
        .td-name,
        .th-title,
        .td-title {
            padding-right: 5px;
            padding-left: 5px;
        }

        .tabella {
            margin: 0px;
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

    .reservation-body {
        display: inline-block;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 60ch;
    }
</style>
