<?php

use Illuminate\Support\Facades\Schedule;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::command('app:send-event-reminders')->daily();
// Schedule::call(fn($schedule) =>   $schedule->command('app:send-event-reminders')
// )->everyMinute();
