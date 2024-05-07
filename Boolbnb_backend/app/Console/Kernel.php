<?php

namespace App\Console;

use App\Models\Accomodation;
use App\Models\Message;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
            try {
                // Get current date and time
                $currentDateTime = now();

                // Find expired accommodations ads and detach them
                DB::table('accomodation_ad')
                    ->where('expiration_date', '<', $currentDateTime)
                    ->orderBy('id') // Adjust 'id' to the actual primary key column
                    ->each(function ($record) {
                        // Detach the record
                        $accomodationId = $record->accomodation_id;
                        $adId = $record->ad_id;
                        Accomodation::find($accomodationId)->ads()->detach($adId);
                    });

                // Log success message
                Log::info('Scheduled task ran successfully.');
            } catch (\Exception $e) {
                // Log error message
                Log::error('Scheduled task failed: ' . $e->getMessage());
            }
        })->everyTenSeconds(); // Adjust the interval as needed
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
