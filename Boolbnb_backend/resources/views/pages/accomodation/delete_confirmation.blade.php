<x-app-layout>
    <div class="container">
        <div class="p-3 rounded-xl">

            <h1 class="font-bold text-xl my-2 ml-6">Are you sure you want to delete: {{$accomodation->title}}? (ID: {{$accomodation->id }})</h1>

            <div class="m-5">
                <div class="card bg-white rounded-lg shadow-lg p-5 justify-center ">

                    @if ($accomodation->thumb)
                        <img src="{{ asset($accomodation->thumb) }}" class="w-full h-auto rounded-t-lg" alt="{{$accomodation->title}}">
                    @endif

                    <div class="p-4">
                        <h1 class="text-lg font-semibold text-gray-800">{{ $accomodation->title }}</h1>
                        <p class="text-sm text-gray-600">{{ $accomodation->address }}, {{ $accomodation->city }}</p>
                    </div>
                </div>
            </div>

            <div class="btn flex justify-center gap-3 p-3">
                <div class="lg-btn">
                    <form action="{{ route('dashboard.accomodations.deleteConfirmed', $accomodation) }}" method="POST">
                        <button type="submit"> @csrf @method('DELETE')
                            <x-button-gradient class="mb-4" type="submit">Delete</x-button-gradient>
                        </button>
                    </form>

                    <a href="{{ route('dashboard') }}">
                        <x-button-gradient type="submit">
                            <p>No please, I have a family ಥ_ಥ</p>
                        </x-button-gradient>
                    </a>
                </div>

                <div class="sm-btn bt-4">
                    <form action="{{ route('dashboard.accomodations.deleteConfirmed', $accomodation) }}" method="POST">
                        <button type="submit" class="uppercase gradient-button mb-4"> @csrf @method('DELETE')
                            Delete
                        </button>
                    </form>

                    <a href="{{ route('dashboard') }}">
                        <button type="submit" class="uppercase gradient-button">
                            <p>No, please ಥ_ಥ</p>
                        </button>
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

<style>

    button{
        width: 100%;
    }
    @media screen and (min-width: 801px) {
        .card{
            width: 400px;
            margin: 0 auto;
        }
        .lg-btn{
            display: block;
        }
        .sm-btn{
            display: none;
        }
    }

    @media screen and (max-width: 800px) {

        .card{
            width: 200px;
            margin: 0 auto;
            padding: 7px;
        }
        .lg-btn{
            display: none;
        }
        .sm-btn{
            display: block;
        }
        .font-bold{
            font-size: 15px;
        }
    }


</style>
