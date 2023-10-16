<?php

namespace App\Console;

use Illuminate\Support\Facades\Log;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Booking;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            // Log::info('Scheduled task is running at ' . now());
            $tenMinutesAgo = now()->subMinutes(2);
            Booking::where('created_at', '<=', $tenMinutesAgo)
                    ->where('booking_status', '!=', 'confirmed')
                    ->delete();
        })->everyMinute(); // Run this task every minute
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
