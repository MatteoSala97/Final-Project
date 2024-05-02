<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="flex h-screen border">
        <div class="w-full">
            <div class="subtitle flex justify-between m-5">
                <h2 class="title">Your Archive </h2>
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

                                <td class="px-6 py-5">{{ $item->price_per_night }} €</td>
                                <td class="border px-4 py-2">
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

    .gradient-button-green {
    background-image: linear-gradient(135deg, #00A9BF, #00FFA3);
    border: none;
    color: white;
    padding: 10px 20px;
    border-radius: 10px;
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
    padding: 10px 20px;
    border-radius: 10px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    }

    .gradient-button-red:hover {
        background-image: linear-gradient(135deg, #cc0000, #FF9D9D);
    }
</style>