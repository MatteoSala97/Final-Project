<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="h-screen border">
        <h2 class="title">Messages ({{ $messages->count() }})</h2>
            <div class="subtitle flex justify-between m-5">
            </div>
            <!-- Table responsive wrapper -->
            <div class="overflow-x-auto bg-white m-5">

                <!-- Table -->
                <table class="min-w-full text-left text-sm whitespace-nowrap">

                <!-- Table head -->
                <thead class="uppercase tracking-wider border-b-2">
                    <tr>
                        <th scope="col" class="px-6 py-5">
                            Sender name
                        </th>
                        <th scope="col" class="px-6 py-5">
                            Message
                        </th>
                        <th scope="col" class="px-6 py-5">
                            Accommodation name
                        </th>
                    </tr>
                </thead>

                <!-- Table body -->
                <tbody>
                    @foreach ($messages as $message)
                        <a href="#">
                            <tr class="border-b hover:bg-neutral-100">
                                <td class="px-6 py-5">{{ $message->name }}</td>
                                <td class="message-body px-6 py-5">{{ $message->content }}</td>
                                <td class="px-6 py-5">{{ $message->accomodation->title }}</td>
                            </tr>
                        </a>
                    @endforeach
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

    main>* {
        width: 100%;
    }

    .message-body {
        display: inline-block;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 60ch;
    }
</style>
