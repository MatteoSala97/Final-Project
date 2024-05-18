<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="h-full w-full mx-4 mt-5">

        <div class="flex items-center px-3 gap-2">
            <a href="{{ route('messages') }}" class="flex items-center">
                <x-arrowleft />
            </a>
            <p class="font-bold text-xl">Messages ({{ $message->name }})</p>
        </div>

        <div class="mt-8 border border-[#EBEBEB] rounded-lg py-4 ">
            <div class="container flex justify-between mx-4">
                <div class="mb-1">
                    <h1 class="font-bold">From:</h1>
                    <p class="email">{{ $message->email }}</p>
                </div>

                <div class="mr-8">
                    <h1 class="font-bold">Date:</h1>
                    <p>{{ date('Y-m-d H:i', strtotime($message->created_at)) }}</p>
                </div>
            </div>

            <hr class="my-4">

            <div class="mx-4 ">
                <h1 class="font-bold">Content:</h1>
                <p class="flex-grow h-[500px]">
                    {{ $message->content }}
                </p>

            </div>


            <div class="reply flex items-center gap-2 ms-auto w-fit cursor-pointer me-6 mb-6"id="reply-icon">
                <span class="text-xl font-semibold">
                    Reply to this message
                </span>
                <i class="fa-solid fa-reply text-3xl"></i>
            </div>
        </div>

    </div>

    <div class="overlay h-screen w-full absolute z-10 bg-gray-400 bg-opacity-90 flex items-center justify-center hidden"
        id="reply-overlay">
        <form method="POST" action="{{ route('reply') }}" class="w-1/3 bg-white p-6 rounded-lg">
            @csrf
            <div class="mt-4 text-gray-800 flex flex-col">
                <i class="fa-solid fa-xmark ms-auto text-xl font-bold cursor-pointer" id="close_icon"></i>
                <label for="content" class="mt-4 text-gray-800">
                    Your Reply to <span class="text-[#8f63f7]">{{ $message->name }}</span>
                </label>
                <input type="hidden" name="accomodation_id" value={{ $message->accomodation_id }}>
                <input type="hidden" name="recipient_email" value={{ $message->email }}>
                <input type="hidden" name="original_message_id" value="{{ $message->id }}">


                <textarea name="content" id="content" cols="30" rows="10" class="w-full mt-4"></textarea>

                <x-input-error :messages="$errors->get('password')" class="mt-2" />

                <x-primary-button class="my-4 mx-auto">
                    {{ __('Send') }}
                </x-primary-button>
            </div>
        </form>

    </div>

    @if ($success)
        <div id="confirmation-modal" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center">
            <div class="bg-white p-6 rounded-lg flex items-center  justify-center flex-col">
                <p class="text-gray-800">Your reply has been sent successfully!</p>
                <x-primary-button class="my-4 mx-auto" id="confirmation-button">
                    {{ __('Continue') }}
                </x-primary-button>
            </div>
        </div>
    @endif



</x-app-layout>

<style>
    @media screen and (max-width: 768px) {
        .container {
            flex-direction: column;
        }
    }

    @media screen and (max-width: 460px) {
        .data {
            text-align: right;
        }

        .font-bold {
            font-size: 15px;
        }
    }
</style>
<script>
    const reply_icon = document.getElementById('reply-icon')
    const reply_overlay = document.getElementById('reply-overlay')
    const close_icon = document.getElementById('close_icon')
    const confirmation_modal = document.getElementById('confirmation-modal')
    const confirmation_button = document.getElementById('confirmation-button')
    reply_icon.addEventListener('click', () => {
        reply_overlay.classList.remove('hidden')
    })
    close_icon.addEventListener('click', () => {
        reply_overlay.classList.add('hidden')
    })
    confirmation_button.addEventListener('click', () => {
        confirmation_modal.classList.add('hidden')
    })
</script>
