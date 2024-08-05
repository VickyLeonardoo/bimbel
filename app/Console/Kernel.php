<?php

namespace App\Console;

use Carbon\Carbon;
use App\Models\Discount;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function() {
            $now = Carbon::now();
            Discount::where('date_valid', '<', $now)
                    ->where('status', true)
                    ->update(['status' => false]);
        })->everyTwoHours();
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
