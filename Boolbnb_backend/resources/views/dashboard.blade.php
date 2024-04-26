<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <img src="{{ asset('storage/uploads/' . $user->user_propic) }}" id="propic">
    </x-slot>


    <div class="flex h-screen border">
        <div class="w-[15%] sidebar flex justify-between flex-col px-10 py-5">
          <div class=" flex flex-col gap-4">
            <div class="sidebar-item">
                <a href="#" class="flex items-center text-left">
                    <img src="/icons/home-alt.svg" class="mr-2" alt="Home">
                    <span>Accommodations</span>
                </a>
           </div>
           <div class="sidebar-item">
                <a href="#" class="flex items-center text-left">
                    <img src="/icons/graph-bar.svg" class="mr-2" alt="">
                    <span>Stats</span>
                </a>
           </div>
           <div class="sidebar-item">
                <a href="#" class="flex items-center  text-left">
                    <img src="/icons/rocket.svg" class="mr-2" alt="">
                    <span>Advertisement</span>
                </a>
           </div>
           <div class="sidebar-item">
                <a href="#" class="flex items-center text-left">
                    <img src="/icons/message-square.svg" class="mr-2" alt="">
                    <span>Messages</span>
                </a>
           </div>
          </div>
           <div class="sidebar-item">
                <a href="#" class="flex items-center text-left">
                    <img src="/icons/user.svg" class="mr-2" alt="">
                    <span>Logout</span>
                </a>
           </div>
        </div>

        <div class="w-[85%] bg-white border">
            <div class="title">
                <h2>Your Accommodations</h2>
            </div>
            <div class="info flex flex-col justify-center items-center h-screen text-grey gap-5">
                <p>
                    There are no accommodations, please start by adding a new one.
                </p>
                <button class="gradient-button">
                    Add accommodation
                </button>
            </div>
        </div>
    </div>

    </div>



</x-app-layout>

<style>
    #propic {
        position: absolute;
        right: 16%;
        top: 2%;
        clip-path: circle();
        width: 55px;
    }

    .sidebar {
        background-color: #F3F4F6;
    }

    .sidebar-item {
        padding: 10px 15px;
        text-decoration: none;
        font-size: 18px;
        display: block;
        font-weight: bold
    }
    .sidebar-item :hover {
        color: #ffffff;
        background-color: #000000;
        border-radius: 20px;
    }
    .sidebar-item :hover img {
        fill: white;
    }
    .sidebar-item img {
        width: 20px;
        height: 20px;
    }
    .title {
        font-size: 1.5rem;
        font-weight: bold;
        padding: 10px 15px;
    }

    .gradient-button {
    background-image: linear-gradient(135deg, #00CBD8, #B844FF);
    border: none;
    color: white;
    padding: 10px 20px;
    font-size: 16px;
    border-radius: 10px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    }
    .gradient-button:hover {
        background-image: linear-gradient(135deg, #00A9BF, #A336DF);
    }

</style>
