<x-app-layout>
    <div class="card pt-5 h-screen">

        <div class="cards rounded overflow-hidden shadow-lg">

            <div class="w-full">
                @if(!empty($accomodation->thumb))
                    <img src="{{ asset($accomodation->thumb) }}" alt="{{ $accomodation->title }}">
                @else
                    <p class="no-img">No image</p>
                @endif
            </div>

            <div class="infos px-3 pt-4 pb-2 flex justify-between">
                <div class="font-bold text-xl mb-2">{{ $accomodation->title }}</div>
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">
                    {{ $accomodation->price_per_night }} € per night
                </span>
            </div>

            <hr>

            <div class="info px-6 pt-4">

                <div class="rooms gap-2 flex justify-between">
                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mb-2">
                        rooms: {{ $accomodation->rooms }}
                    </span>
                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mb-2">
                        beds: {{ $accomodation->beds }}
                    </span>
                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mb-2">
                        bathrooms: {{ $accomodation->bathrooms }}
                    </span>
                </div>

            </div>


        </div>
    </div>



</x-app-layout>

<style>
    .no-img{
        background-color: rgb(240, 240, 240);
        text-align: center;
        height: 200px;
        color: rgb(119, 119, 119);
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .card {
        margin:0 auto;
    }
    img{
        height: 200px;
        width: 100%;
    }


    @media screen and (max-width: 470px){
        body{
            /* background-color: red; */
        }
        .cards{
            width: 275px;
        }
        .font-bold{
            font-size: 15px;
        }
    }

    @media screen and (max-width: 470px){
        .cards{
            width: 280px;
        }
    }

    @media screen and (max-width: 390px){
        .cards{
            width: 200px;
        }
        .infos{
            flex-direction: column;
        }
        .rooms{
            flex-direction: column-reverse;
        }
    }

</style>
