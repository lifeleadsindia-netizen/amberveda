<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        \App\Console\Commands\BinaryIncomedis::class,
        \App\Console\Commands\SalesBonusInc::class,
        \App\Console\Commands\RewardsGen::class,
        \App\Console\Commands\UpdateClub::class,
        \App\Console\Commands\ClubIncomeDis::class,
        \App\Console\Commands\TravelFund::class,
        \App\Console\Commands\WeeklyPayouts::class,
    ];

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('app:binary-incomedis')->daily();
        $schedule->command('app:sales-bonus-inc')->daily();
        $schedule->command('app:rewards-gen')->everyFifteenMinutes();
        $schedule->command('app:update-club')->everyFifteenMinutes();
        $schedule->command('app:club-income-dis')->monthly();
        $schedule->command('app:travel-fund')->everyFifteenMinutes();
        $schedule->command('app:weekly-payouts')->daily();
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
