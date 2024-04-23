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

    <div class="card" style="width: 18rem;">
        {{-- possible conflict between  url and local path --}}
        @if ($accomodation->thumb)
            <img src="{{ asset('storage/uploads/' . $accomodation->thumb) }}" class="card-img-top" alt="...">
        @endif

        <div class="card-body">
            <h5 class="card-title">{{ $accomodation->title }}</h5>
            <p class="card-text">{{ $accomodation->address }}, {{ $accomodation->city }}</p>

        </div>
    </div>









</body>

</html>
