<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Repair;
use Carbon\Carbon;

class UpdateScheduledRepairs extends Command
{
    protected $signature = 'repairs:update-status';
    protected $description = 'Update scheduled repairs to failed if the scheduled_date has passed';

    public function handle()
    {
        $now = Carbon::now()->format('Y-m-d');

        $updated = Repair::where('status', 'scheduled')
            ->where('scheduled_date', '<',  $now)

            ->update(['status' => 'failed']);

        $this->info("$updated repairs updated to failed.");
    }
}
