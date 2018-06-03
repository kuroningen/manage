<?php namespace project\conf\kernel;

use Illuminate\Console\Scheduling\Schedule as schedule;
use Illuminate\Foundation\Console\Kernel as consoleKernel;

/**
 * Class console
 * @package project\conf\kernel
 * @author  黒人間 <kuroningen@ano.nymous.xyz>
 * @since   2018.04.19
 */
class console extends consoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\schedule  $schedule
     * @return void
     */
    protected function schedule(schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('../project/conf/routes/console.php');
    }
}