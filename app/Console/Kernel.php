<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('app:add-records-to-la-liga-table');
        $schedule->command('app:add-records-to-top-assist-table');
        $schedule->command('app:add-records-to-top-score-table');
        $schedule->command('app:add-records-to-player-table');
        $schedule->command('app:add-records-to-game-table');
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
