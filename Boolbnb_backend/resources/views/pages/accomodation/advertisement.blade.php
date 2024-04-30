<x-app-layout>
    <div class="container w-9/12">

        <div class="my-5 flex gap-5 items-center ml-4">
            {{-- <a href="{{ route('dashboard') }}" class="flex items-center">
                <x-arrowleft/>
            </a> --}}
            <p class="font-bold text-xl">Advertisement</p>
        </div>

        <form class="ms-4" action="" method="POST" enctype="multipart/form-data"> @csrf

            <div class=" flex justify-between gap-4 mb-4" style="">
                <div class="ads border border-gray-200 rounded-xl flex gap-3 p-6 w-2/6">
                    <x-silver_svg/>
                    <div class="flex-1 flex flex-col justify-between">
                        <div class="text-left">
                            <h1 class="title">Silver</h1>
                            <p class="">€2,99 for 24 hours</p>
                        </div>
                    </div>
                </div>

                <div class="ads border border-gray-200 rounded-xl flex gap-3 p-6 w-2/6">
                    <x-gold_svg/>
                    <div class="flex-1 flex flex-col justify-between">
                        <div class="text-left">
                            <h1 class="title">Gold</h1>
                            <p class="">€5,99 for 72 hours</p>
                        </div>
                    </div>
                </div>

                <div class="ads border border-gray-200 rounded-xl flex gap-3 p-6 w-2/6">
                    <x-platinum_svg/>
                    <div class="flex-1 flex flex-col justify-between">
                        <div class="text-left">
                            <h1 class="title">Platinum</h1>
                            <p class="">€9,99 for 144 hours</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="border border-gray-200 rounded-xl p-52 flex justify-center mt-4">
                <div class="flex flex-col justify-center items-center">
                    <p class="text-center">There are no advertised accommodations with this package</p>
                    <div class="mt-4">
                        <x-button-gradient type="submit" class="gradient-button">
                            <button class="uppercase">Advertise an accommodation</button>
                        </x-button-gradient>
                    </div>
                </div>
            </div>

        </form>
    </div>
</x-app-layout>

<style>
    .ads:hover{
        border: 1px solid black;
    }
</style>
