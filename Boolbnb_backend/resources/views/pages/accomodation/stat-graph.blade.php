<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="h-full w-full p-4">

        <div class="flex items-center px-3 gap-2">
            <a href="{{ route('stats') }}" class="flex items-center">
                <x-arrowleft />
            </a>
            <p class="font-bold text-xl"> Statistics</p>
            <p class="font-bold text-xl"> {{ $accomodation->title }}</p>
        </div>

        <div class="stats-container mt-4 flex gap-2 p-2 lg:p-8 ">
            <div class="views-container flex items-center gap-3 lg:w-[350px] w-[120px] lg:gap-6">
                <img src="{{ asset('icons/views-colored.svg') }}" alt="views-icon" class="w-[50px] lg:w-[80px]">
                <div class="info-text ">
                    <p class="text-sm lg:text-base">
                        Total Views
                    </p>
                    <div class="font-extrabold text-lg lg:text-xl mt-1">
                        {{ $accomodation->views()->count() }}
                    </div>
                </div>
            </div>
            <div class="messages-container flex items-center gap-3 lg:w-[350px] w-[120px] lg:gap-6">
                <img src="{{ asset('icons/message-colored.svg') }}" alt="messages-icon" class="w-[50px] lg:w-[80px]">
                <div class="info-text ">
                    <p class="text-sm lg:text-base">
                        Total Messages
                    </p>
                    <div class="font-extrabold text-lg lg:text-xl mt-1">
                        {{ $accomodation->messages()->count() }}
                    </div>
                </div>
            </div>
        </div>

        <canvas id="accomodation_chart" class="overflow-hidden"></canvas>

    </div>

</x-app-layout>


<script>
    const labels = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October",
        "November", "December"
    ];

    // Initialize arrays for messages and views counts for each month
    let messageCounts = Array(12).fill(0);
    let viewCounts = Array(12).fill(0);

    // Fetching data from Blade template and processing it
    @foreach ($accomodation->messages()->whereYear('created_at', now()->year)->get() as $index => $message)
        let messageMonthIndex{{ $index }} = new Date("{{ $message->created_at }}").getMonth();
        messageCounts[messageMonthIndex{{ $index }}]++;
    @endforeach

    @foreach ($accomodation->views()->whereYear('created_at', now()->year)->get() as $index => $view)
        let viewMonthIndex{{ $index }} = new Date("{{ $view->created_at }}").getMonth();
        viewCounts[viewMonthIndex{{ $index }}]++;
    @endforeach

    console.log(viewCounts)

    // Create the data object for Chart.js
    const data = {
        labels: labels,
        datasets: [{
                label: 'Views',
                data: viewCounts,
                borderColor: '#ccf5f7',
                backgroundColor: '#ccf5f7',
                yAxisID: 'y',
            },

            {
                label: 'Messages',
                data: messageCounts,
                borderColor: '#e9c6ff',
                backgroundColor: '#e9c6ff',
                yAxisID: 'y1',
            },



        ]
    };

    // Chart configuration
    const config = {
        type: 'line',
        data: data,
        options: {
            responsive: true,
            interaction: {
                mode: 'index',
                intersect: false,
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Messages and Views Stats for ' + new Date().getFullYear()
                }
            },
            scales: {
                y: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    suggestedMax: Math.max(...viewCounts) + 10, // Adjust the max value of y-axis for views
                },
                y1: {
                    type: 'linear',
                    display: true,
                    position: 'right',
                    suggestedMax: Math.max(...messageCounts) + 10, // Adjust the max value of y-axis for messages
                    grid: {
                        drawOnChartArea: false,
                    },
                },
            }
        },
    };

    // Initialize the chart
    const ctx = document.getElementById('accomodation_chart').getContext('2d');
    ctx.canvas.style.width = '70vw';
    ctx.canvas.style.height = '50vh';
    const myChart = new Chart(ctx, config);
</script>
