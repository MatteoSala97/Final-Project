<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="flex h-screen ">
        <div class="w-full">
            <div class="subtitle flex justify-between m-5 mb-6">
                <p class="font-bold text-xl mx-4">Your Archive</p>

            </div>
            <!-- Table responsive wrapper -->
            <div class="overflow-x-auto bg-white mx-4">
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
                            <th scope="col" class="px-6 py-5 th-price_per_night">
                                Price per night
                            </th>
                            <th scope="col" class="px-6 py-5 th-btn">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <!-- Table body -->
                    <tbody>
                        @foreach ($accomodations as $item)
                            <tr class="border border-x-0 hover:bg-neutral-100 {{ $item->hidden ? 'text-gray-600' : '' }}">
                                <td scope="row" class="px-6 py-5 th-id" style="height: 80px">
                                    @if ($item->thumb)
                                        <img src="{{ asset($item->thumb) }}"
                                            style="height: 80px" class="{{ $item->hidden ? 'grayscale' : '' }}"
                                            id="old_thumb">
                                    @else
                                        <span>
                                            {{ $item->id }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-5 td-title">{{ $item->title }}</td>
                                <td class="px-6 py-5 td-type">{{ $item->type }}</td>
                                <td class="px-6 py-5 td-address">{{ $item->address }}</td>
                                <td class="px-6 py-5 td-price_per_night">{{ $item->price_per_night }} €</td>
                                <td class="px-4 py-2 td-btn">
                                    <div class="flex gap-2 justify-around">
                                        <!-- Restore Form -->

                                        <button type="submit" class="gradient-button-green">Restore</button>

                                        <!-- Permanently Delete Form -->

                                        <button type="submit" class="gradient-button-red">Delete Permanently</button>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-5 mx-10">
                <!-- Visualizzazione dei link per la paginazione -->
                {{ $accomodations->links() }}
            </div>
        </div>
    </div>
</x-app-layout>

<style>

    body{
        /* background-color: #00A9BF; */
    }

    .td-address{
        /* background-color: red; */
        max-width: 200px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    /* 1270 */
    @media screen and (max-width: 1270px){
        .th-id{
            /* background-color: blue; */
            max-width: 130px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

    }

    @media screen and (max-width: 1200px){
        .td-address{
            /* background-color: blue; */
            max-width: 150px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .th-price_per_night{
            /* background-color: blue; */
            max-width: 130px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .gradient-button-red {
            padding: 10px 5px;

        }

        .gradient-button-green {
            padding: 10px 5px;

        }


    }
    @media screen and (max-width: 1100px){
        body{
            /* background-color: gold; */
        }
        .td-address{
            max-width: 150px;
        }
        .td-type, .th-type{
            display: none;
        }
        .td-id,
        .td-title,
        .td-type,
        .td-address,
        .td-price_per_night,
        .td-btn{
            /* background-color: yellow; */
            padding: 10px;
        }
        .th-id,
        .th-title,
        .th-type,
        .th-address,
        .th-price_per_night,
        .th-btn{
            /* background-color: green; */
            padding: 10px;
        }


    }

    @media screen and (max-width: 980px){
        .th-price_per_night{
            /* background-color: blue; */
            max-width: 110px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .th-id{
            max-width: 110px;
        }
        .th-price_per_night{
            /* background-color: purple; */
            max-width: 80px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

    }

    @media screen and (max-width: 870px){
        .th-id{
            max-width: 110px;
        }
        .td-price_per_night, .th-price_per_night{
            display: none;
        }

        .td-address{
            /* background-color: purple; */
            max-width: 80px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }


    }

    @media screen and (max-width: 768px){

        body{
            /* background-color: gold; */
        }

        .td-id,
        .td-title,
        .td-type,
        .td-address,
        .td-price_per_night,
        .td-btn{
            /* background-color: yellow; */
            padding: 10px;
        }
        .th-id,
        .th-title,
        .th-type,
        .th-address,
        .th-price_per_night,
        .th-btn{
            /* background-color: green; */
            padding: 10px;
        }


        .td-address{
            /* background-color: blue; */
            max-width: 100px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .td-id, .th-id{
            display: none;
        }
    }


    @media screen and (max-width: 460px){
        body{
            /* background-color: gold; */
        }

        .th-id,
        .th-title,
        .th-type,
        .th-address,
        .th-price_per_night,
        .th-btn{
            padding: 3px;
        }

        .th-address, .td-address{
            display: none;
        }

        .td-id,
        .td-title,
        .td-type,
        .td-address,
        .td-price_per_night,
        .td-btn{
            padding: 3px;
            gap: 0;
        }

        .gradient-button-red {
            padding: 7px 4px;

        }

        .gradient-button-green {
            padding: 7px 4px;

        }

    }
    @media screen and (max-width: 350px){
        body{
            /* background-color: black; */
        }
    }

    .gradient-button-green {
        background-image: linear-gradient(135deg, #00A9BF, #00FFA3);
        border: none;
        color: white;
        padding: 10px 10px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .gradient-button-green:hover {
        background-image: linear-gradient(135deg, #19b4c9, #1ebb81);
    }


    .gradient-button-red {
        background-image: linear-gradient(135deg, #FF3E3E, #FF9D9D);
        border: none;
        color: white;
        padding: 10px 10px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .gradient-button-red:hover {
        background-image: linear-gradient(135deg, #cc0000, #FF9D9D);
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

</style>
