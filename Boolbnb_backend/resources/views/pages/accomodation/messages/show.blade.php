<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="h-screen w-full border p-5">

        <div class="flex items-center px-3 gap-2">
            <a href="{{ route('messages') }}" class="flex items-center">
                <x-arrowleft/>
            </a>
            <p class="font-bold text-xl">Messages ({{ $message->count() }})</p>
        </div>
    
        {{-- <div>
            <p><strong>Email:</strong> {{ $message->email }}</p>
            <p><strong>Body:</strong> {{ $message->content }}</p>
            <p><strong>Address:</strong> {{ $message->accomodation->title }}</p>
        </div> --}}

        <div class="mt-8 border border-[#EBEBEB] rounded-lg p-6">

            <div class="flex justify-between items-center">
                <div class="flex gap-5 items-center">
                    <figure>
                        {{-- <img src="{{ $message->accomodation->host_thumb }}" alt=""> --}}
                        {{-- <div class="p-7 bg-[#D9D9D9] rounded-full"></div> --}}
                    </figure>
                    <p>{{ $message->email }}</p>
                </div>
                <div>
                    {{ $message->created_at }}
                </div>
            </div>

            <hr class="my-8">

            <div>
                {{ $message->content }}
            </div>

        </div>
    </div>

</x-app-layout>
