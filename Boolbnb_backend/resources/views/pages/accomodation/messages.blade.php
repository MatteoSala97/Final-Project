<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="h-screen border">
        <div class="subtitle flex justify-between m-5">
            <h2 class="title">Messages</h2>
        </div>

        <!-- Table responsive wrapper -->
        <div class="overflow-x-auto bg-white m-5">

            <!-- Table -->
            <table class="min-w-full text-left text-sm whitespace-nowrap">

                <!-- Table head -->
                <thead class="uppercase tracking-wider border-b-2">
                    <tr>
                        <th scope="col" class="px-6 py-5">
                            Sender email
                        </th>
                        <th scope="col" class="px-6 py-5">
                            Message
                        </th>
                        <th scope="col" class="px-6 py-5">
                            Accommodation address
                        </th>
                    </tr>
                </thead>

                <!-- Table body -->
                <tbody>
                    <tr class="border-b hover:bg-neutral-100">
                        <td class="px-6 py-5">email</td>
                        <td class="px-6 py-5">lorem ipsum</td>
                        <td class="px-6 py-5">via san secondo</td>
                    </tr>
                </tbody>

            </table>
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

    main > * {
        width: 100%;
    }

</style>