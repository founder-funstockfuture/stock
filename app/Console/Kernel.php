<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    protected $commands = [
        Commands\SyncCmoneyDatabases::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        // 每隔一個小時執行一遍
        // $schedule->command('larabbs:calculate-active-user')->hourly();
        // 每日零時執行一次
        $schedule->command('stock:sync-user-actived-at')->dailyAt('00:00');
    }
}
