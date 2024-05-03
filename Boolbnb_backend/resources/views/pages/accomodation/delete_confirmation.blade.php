<x-app-layout>
    <div class="container m-52">
        <div class="p-3 border rounded-xl">

            <h1 class="font-bold text-xl">Are you sure you want to delete: {{$accomodation->title}}? ({{ $accomodation->count() }})</h1>

            <div class="flex justify-center m-5" >
                <div class="bg-red-200" style="width: 18rem;">

                    @if ($accomodation->thumb)
                        <img src="{{ asset('storage/uploads/' . $accomodation->thumb) }}" class="bg-blue-200" alt="{{$accomodation->title}}">
                    @endif

                    <h1>{{ $accomodation->title }}</h1>
                    <p>{{ $accomodation->address }}, {{ $accomodation->city }}</p>
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
