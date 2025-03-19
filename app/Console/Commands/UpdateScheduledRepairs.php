<?php

namespace App\Console\Commands;

use App\Models\RateUser;
use Carbon\Carbon;
use App\Models\Repair;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateScheduledRepairs extends Command
{
    protected $signature = 'repairs:update-status';
    protected $description = 'Update scheduled repairs to failed if the scheduled_date has passed';



    public function handle()
    {
        $now = Carbon::now()->format('Y-m-d');

        // **1. Update status menjadi 'failed' jika tanggal sudah lewat**
        Repair::where('status', 'scheduled')
            ->where('scheduled_date', '<', $now)
            ->update(['status' => 'failed']);

        // **2. Ambil data yang memiliki status 'failed'**
        $failedRepairs = Repair::where('status', 'failed')
            ->where('scheduled_date', '<', $now)
            ->get();

        foreach ($failedRepairs as $repair) {
            // Update status di repair_teams jika sudah ada
            DB::table('repair_teams')->where('repair_id', $repair->id_repair)
                ->update(['status' => 'failed']);
        }

        // **3. Ambil data yang memiliki status 'completed'**
        $completedRepairs = Repair::where('status', 'completed')->get();

        foreach ($completedRepairs as $repair) {
            // Update status di repair_teams jika sudah ada
            DB::table('repair_teams')->where('repair_id', $repair->id_repair)
                ->update(['status' => 'completed']);
        }

        $this->info(count($failedRepairs) . " repairs marked as failed and status updated in RepairTeam.");
        $this->info(count($completedRepairs) . " repairs marked as completed and status updated in RepairTeam.");
    }
}
