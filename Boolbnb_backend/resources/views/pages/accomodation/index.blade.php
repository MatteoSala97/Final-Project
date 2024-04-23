<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        {{-- <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <!-- Scripts -->
        {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    </head>
<body>

    <h1>INDEX</h1>

    {{-- <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
        <x-nav-link :href="route('dashboard')">
            {{ __('torna indietro') }}
        </x-nav-link>
    </div> --}}

    {{-- <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
        <x-nav-link :href="route('dashboard.accomodations.create')">
            {{ __('create') }}
        </x-nav-link>
    </div> --}}


    <div class="container">

        <div class="d-flex gap-2 my-4">
            <h2>Tabella</h2>

            <a href="{{ route('dashboard.accomodations.create')}}"
                class="btn btn-primary d-flex align-items-center">
                Crea
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-secondary">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">title</th>
                        <th scope="col">rooms</th>
                        <th scope="col">beds</th>
                        <th scope="col">bathooms</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($accomodations as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->title}}</td>
                            <td>{{$item->rooms}}</td>
                            <td>{{$item->beds}}</td>
                            <td>{{$item->bathooms}}</td>
                            {{-- <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('dashboard.accomodations.edit', $item->id)}}"
                                        class="btn btn-warning">
                                        Modifica
                                    </a>

                                    <form method="POST" action="{{route('dashboard.accomodations.destroy', $item->id)}}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger">Elimina</button>
                                    </form>
                                </div>
                            </td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
