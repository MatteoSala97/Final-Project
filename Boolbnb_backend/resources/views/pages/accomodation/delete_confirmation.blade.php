<x-app-layout>
    <div class="container m-52">
        <div class="p-3 border rounded-xl">

            <h1 class="font-bold text-xl">Are you sure you want to delete: {{$accomodation->title}}? (ID: {{$accomodation->id }})</h1>

            <div class="flex justify-center m-5">
                <div class="bg-white rounded-lg shadow-lg p-5" style="width: 18rem;">

                    @if ($accomodation->thumb)
                        <img src="{{ asset($accomodation->thumb) }}" class="w-full h-auto rounded-t-lg" alt="{{$accomodation->title}}">
                    @endif

                    <div class="p-4">
                        <h1 class="text-lg font-semibold text-gray-800">{{ $accomodation->title }}</h1>
                        <p class="text-sm text-gray-600">{{ $accomodation->address }}, {{ $accomodation->city }}</p>
                    </div>
                </div>
            </div>

            <div class="flex justify-center gap-3 p-3">

                <form action="{{ route('dashboard.accomodations.deleteConfirmed', $accomodation) }}" method="POST">
                    <button type="submit"> @csrf @method('DELETE')
                        <x-button-gradient class="uppercase" type="submit">Delete</x-button-gradient>
                    </button>
                </form>

                <a href="{{ route('dashboard') }}">
                    <x-button-gradient type="submit">
                        <p>No please, I have a family ಥ_ಥ</p>
                    </x-button-gradient>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
