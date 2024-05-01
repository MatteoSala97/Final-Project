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
                    {{-- @foreach ($messages as $item) --}}
                    <a href="#">
                        <tr class="border-b hover:bg-neutral-100">
                                <td class="px-6 py-5">email@email.com</td>
                                <td class="message-body px-6 py-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean non ante feugiat, dictum nulla vel, congue nisi. Nulla odio ipsum, pellentesque sed varius at, posuere in enim. Proin at nibh porttitor, tincidunt ex vitae, euismod est. Vestibulum nec porttitor eros, quis consequat risus. Cras at neque magna. Aliquam ornare auctor lorem eu mattis. Curabitur ut mauris dapibus, gravida quam vitae, lacinia nisi. Pellentesque orci nisi, blandit eget justo non, facilisis consectetur quam. Maecenas tristique vestibulum congue. Pellentesque id felis eget tellus varius scelerisque. Proin dapibus magna massa, a rhoncus turpis dictum rhoncus. Aenean at tellus sollicitudin, tristique velit at, blandit orci.</td>
                                <td class="px-6 py-5">via san secondo</td>
                        </tr>
                    </a>
                    {{-- @endforeach --}}
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

    .message-body {
        display:inline-block;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 60ch;
    }

</style>