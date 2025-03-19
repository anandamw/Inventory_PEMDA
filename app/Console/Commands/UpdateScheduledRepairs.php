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

        // Update status menjadi 'failed' terlebih dahulu
        Repair::where('status', 'scheduled')
            ->where('scheduled_date', '<', $now)
            ->update(['status' => 'failed']);

        // Ambil kembali data yang sudah diperbarui
        $repairs = Repair::where('status', 'failed')
            ->where('scheduled_date', '<', $now)
            ->get();

        // Insert ke RateUser hanya jika belum ada entri yang sama
        foreach ($repairs as $repair) {
            $existing = RateUser::where('users_id', $repair->user_id)
                ->where('repair', $repair->repair)
                ->where('status', 'failed')
                ->exists(); // Mengecek apakah data sudah ada

            if (!$existing) {
                RateUser::insert([
                    'users_id' => $repair->user_id,
                    'status' => $repair->status, // Status sudah 'failed'
                    'repair' => $repair->repair,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        $this->info(count($repairs) . " repairs updated to failed and recorded in RateUser (without duplicates).");
    }
}
