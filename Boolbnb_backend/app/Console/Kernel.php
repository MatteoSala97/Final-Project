<?php

namespace App\Console;

use App\Models\Accomodation;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
            $now = now();

            // Get all accommodations with ads
            $accommodations = Accomodation::whereHas('ads')->get();

            // Loop through each accommodation
            foreach ($accommodations as $accommodation) {
                // Get ads for the current accommodation
                $ads = $accommodation->ads;

                // Check each ad for expiration
                foreach ($ads as $ad) {
                    // Check if the ad has expired
                    if ($ad->pivot->expiration_date <= $now) {
                        // Soft delete the ad
                        $accommodation->ads()->detach($ad->id);
                    }
                }
            }
        })->hourly();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
