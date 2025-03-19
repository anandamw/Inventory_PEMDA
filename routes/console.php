<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command('repairs:update-status')->everyFiveSeconds(); // test
// Schedule::command('repairs:update-status')->everyThirtyMinutes(); // production
