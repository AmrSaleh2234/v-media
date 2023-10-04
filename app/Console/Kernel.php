<?php

namespace App\Console;

use App\Console\Commands\DeleteTempUploadedFiles;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
//        $schedule->command('backup:run')->daily()->at('01:00');
//        $schedule->command(DeleteTempUploadedFiles::class)->hourly();
        $schedule->command('app:check-offline-employee')->everyFiveMinutes()
            ->timezone('Africa/Cairo')
            ->days([0,1,2,3,4]) // Exclude Friday (5) and Saturday (6)
            ->between('7:00', '20:00');

        // notification offical paper
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
// php  /home/visiondimensions/public_html/artisan schedule:run  1>> /dev/null 2>&1
// cd /home/visiondimensions/public_html && php artisan schedule:run >> /dev/null 2>&1
