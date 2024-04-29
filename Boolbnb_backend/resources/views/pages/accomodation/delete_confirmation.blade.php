<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="bg-secondary rounded-3 my-3 p-3">

            <h2 class="text-center">Are you sure you want to delete: {{$accomodation->title}}?</h2>

            <div class="d-flex justify-content-center my-3">
                <div class="card " style="width: 18rem;">
                    {{-- possible conflict between  url and local path --}}
                    @if ($accomodation->thumb)
                        <img src="{{ asset('storage/uploads/' . $accomodation->thumb) }}" class="card-img-top" alt="...">
                    @endif

                    <div class="card-body">
                        <h5 class="card-title">{{ $accomodation->title }}</h5>
                        <p class="card-text">{{ $accomodation->address }}, {{ $accomodation->city }}</p>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2 justify-content-center">
                <form action="{{ route('dashboard.accomodations.deleteConfirmed', $accomodation) }}" method="POST">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger" type="submit">Delete</button>
                </form>


                    <a href="{{ route('dashboard') }}" class="btn btn-warning">
                        <p>No please, I have a family ಥ_ಥ</p>
                    </a>



            </div>

        </div>
    </div>
</body>
</html>
