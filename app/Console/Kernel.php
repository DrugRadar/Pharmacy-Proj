<?php

namespace App\Console;

use App\Console\Commands\CreateAdminCommand;
use App\Console\Commands\NotifyInactiveClients;
use App\Console\Commands\ScanNewOrders;
use App\Console\Commands\UnbanUserCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('app:notify-inactive-clients')->daily();
        $schedule->command('app:notify-inactive-clients')->everyMinute();
        $schedule->command('orders:scan-new-orders')->everyMinute();
        $schedule->command('unban-doctor')->dailyAt('00:00');

    }
    protected $commands = [
        // ...
        CreateAdminCommand::class,
        NotifyInactiveClients::class,
        UnbanUserCommand::class,
        ScanNewOrders::class,
    ];
    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
