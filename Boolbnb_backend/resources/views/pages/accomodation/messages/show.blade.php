<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="h-screen w-full mx-4 mt-5">

        <div class="flex items-center px-3 gap-2">
            <a href="{{ route('messages') }}" class="flex items-center">
                <x-arrowleft/>
            </a>
            <p class="font-bold text-xl">Messages ({{ $message->name }})</p>
        </div>

        <div class="mt-8 border border-[#EBEBEB] rounded-lg py-4">
            <div class="container flex justify-between mx-4">
                <div class="mb-1">
                    <h1 class="font-bold">From:</h1>
                    <p class="email">{{ $message->email }}</p>
                </div>

                <div class="mr-8">
                    <h1 class="font-bold">Date:</h1>
                    <p>{{ $message->created_at }}</p>
                </div>
            </div>

            <hr class="my-4">

            <div class="mx-4">
                <h1 class="font-bold">Content:</h1>
                {{ $message->content }}
            </div>

        </div>
    </div>

</x-app-layout>

<style>
    @media screen and (max-width: 768px){
        .container{
            flex-direction: column;
        }
    }

    @media screen and (max-width: 460px){
        .data{
            text-align: right;
        }

        .font-bold{
            font-size: 15px;
        }
    }

</style>
