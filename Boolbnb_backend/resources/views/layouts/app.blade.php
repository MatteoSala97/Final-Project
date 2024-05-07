<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Bool BnB Dashboard</title>

    <link rel="shortcut icon" href="{{ asset('logo-colored.svg') }}" >

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Scripts -->
    <script src="https://js.braintreegateway.com/web/dropin/1.42.0/js/dropin.min.js"></script>
    <script src="http://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen">
        @include('layouts.navigation')

        <!-- Page Heading -->
        {{-- @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif --}}

        <!-- Page Content -->
        <main class="dashboard flex">

            {{-- Accommodations / Stats / Advertisement / Messages / Logout --}}
            <div class="sidebar flex flex-col pt-4 px-5 border border-y-0 border-l-0">
                <div class="flex flex-col gap-4">

                    <div class="sidebar-item {{ request()->routeIs('dashboard') ? 'active-bg' : '' }}">
                        <a href="{{ route('dashboard') }}" class="flex items-center text-left">
                            <img src="/icons/home-alt.svg" class="mr-1" alt="home">
                            <span>Accommodations</span>
                        </a>
                    </div>
                    <div class="sidebar-item {{ request()->routeIs('stats') ? 'active-bg' : '' }}">
                        <a href="{{ route('stats') }}" class="flex text-left">
                            <img src="/icons/graph-bar.svg" class="mr-1" alt="stats">
                            <span>Stats</span>
                        </a>
                    </div>
                    <div class="sidebar-item {{ request()->routeIs('dashboard.accomodations.advertisement') ? 'active-bg' : '' }}">
                        <a href="{{ route('dashboard.accomodations.advertisement') }}"
                            class="flex items-center text-left">
                            <img src="/icons/rocket.svg" class="mr-1" alt="ads">
                            <span>Advertisement</span>
                        </a>
                    </div>
                    <div class="sidebar-item {{ request()->routeIs('messages') ? 'active-bg' : '' }}">
                        <a href="{{ route('messages') }}" class="flex items-center text-left">
                            <img src="/icons/message-square.svg" class="mr-1" alt="message">
                            <span>Messages</span>
                        </a>
                    </div>

                </div>
                {{-- log --}}
                {{-- <div class="sidebar-item mt-auto mb-4">
                    <a href="#" class="flex items-center text-left">
                        <img src="/icons/user.svg" class="mr-1" alt="">
                        <span>Logout</span>
                    </a>
                </div> --}}
            </div>

            {{ $slot }}
        </main>

    </div>
</body>
</html>


<script>
    // document.addEventListener("DOMContentLoaded", function() {
    //     var currentUrl = window.location.href;
    //     var sidebarLinks = document.querySelectorAll('.sidebar-item a');
    //     sidebarLinks.forEach(function(link) {

    //         var linkUrl = link.getAttribute('href');

    //         if (currentUrl === linkUrl) {
    //             link.classList.add('active');
    //         }
    //     });
    // });
</script>

<style>
    @media screen and (max-width: 700px){
        .sidebar {
            width: 210px;
        }
        span{
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }
    }
    @media screen and (max-width: 600px){
        .sidebar {
            width: 80px;
        }
        span{
            display: none;
        }
        .sidebar-item{
            padding: 10px;
            display: flex;
            justify-content: center;
        }
    }















    /* .sidebar-item {
    padding: 10px 30px 10px 10px;
    font-size: 18px;
    font-weight: bold;
}
.sidebar-item:hover {

}
.sidebar-item:hover img {
    filter: invert(1);
}
.sidebar-item img {
    width: 20px;
    height: 20px;

}

.sidebar-item a.active {
    color: white;
    background-color: aqua;
    border-radius: 20px;
    font-size: 18px;
    font-weight: bold;
    padding: 10px 150px 10px 10px;
}


.sidebar {
    height: calc(90vh - 0vh);
    flex: 0 0 auto;
    width: 250px;
}
.sidebar-item {
    padding: 10px 30px 10px 10px;
    font-size: 18px;
    font-weight: bold;
}
.sidebar-item:hover {
    color: white;
    background-color: black;
    border-radius: 20px;
}
.sidebar-item:hover img {
    filter: invert(1);
}
.sidebar-item img {
    width: 20px;
    height: 20px;
}
.title {
    font-size: 1.5rem;
    font-weight: bold;
} */




</style>

