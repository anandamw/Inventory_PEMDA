<?php

namespace App\Providers;

use App\Models\Asset;
use App\Models\Repair;
use App\Models\Inventory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\Facades\Schema;
use App\Http\Middleware\UpdateLastSeen;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */

    public function boot(Kernel $kernel): void
    {
        if (!app()->runningInConsole() || app()->runningUnitTests()) {
            // Pastikan tabel sudah ada sebelum mengambil data
            if (Schema::hasTable('inventories') && Schema::hasTable('assets')) {
                // Ambil item dengan stok rendah
                $lowStockItems = Inventory::where('quantity', '<', 10)
                    ->select('code_item', 'item_name', 'img_item', 'quantity')
                    ->get();
                $lowStockCount = $lowStockItems->count();

                // Ambil aset yang pending
                $pendingAssets = Asset::where('status', 'pending')
                    ->select('name', 'quantity', 'image', 'status', 'description')
                    ->get();
                $pendingAssetCount = $pendingAssets->count();

                // Share data ke semua view
                View::share('lowStockCount', $lowStockCount);
                View::share('lowStockItems', $lowStockItems);
                View::share('pendingAssets', $pendingAssets);
                View::share('pendingAssetCount', $pendingAssetCount);
            }
        }

        if (!app()->runningInConsole() || app()->runningUnitTests()) {
            if (Schema::hasTable('repairs')) {
                View::composer('*', function ($view) {
                    $userRepairs = collect();
                    $scheduledRepairsCount = 0;
                    $overdueRepairs = collect();
                    $overdueRepairsCount = 0;


                    if (auth()->check()) {
                        $userRepairs = Repair::where('user_id', auth()->id())
                            ->with(['admin', 'repairTeam']) // Pastikan memuat relasi repairTeam
                            ->orderBy('scheduled_date', 'desc')
                            ->get();


                        $scheduledRepairsCount = $userRepairs->where('status', 'scheduled')->count();

                        if (auth()->check()) {

                            // Ambil perbaikan yang sudah melewati scheduled_date dan masih berstatus scheduled
                            $overdueRepairs = DB::table('repairs')
                                ->leftJoin('users as users_reporter', 'repairs.user_id', '=', 'users_reporter.id')  // Pelapor
                                ->leftJoin('users as users_admin', 'repairs.admin_id', '=', 'users_admin.id')  // Admin
                                ->leftJoin('repair_teams', 'repairs.id_repair', '=', 'repair_teams.repair_id')  // Hubungan ke tim
                                ->leftJoin('users as users_team', 'repair_teams.user_id', '=', 'users_team.id')  // Tim yang menangani
                                ->where('repairs.scheduled_date', '<', Carbon::today())
                                ->where('repairs.status', 'failed')
                                ->select(
                                    'repairs.id_repair',
                                    'repairs.repair',
                                    'repairs.scheduled_date',
                                    'repairs.status',
                                    'users_reporter.name as reporter_name',
                                    'users_admin.name as admin_name',
                                    DB::raw("COALESCE(GROUP_CONCAT(users_team.name SEPARATOR ', '), 'Belum Ditugaskan') as team_names")
                                )
                                ->groupBy('repairs.id_repair', 'repairs.repair', 'repairs.scheduled_date', 'repairs.status', 'users_reporter.name', 'users_admin.name')
                                ->orderBy('repairs.scheduled_date', 'desc')
                                ->get();


                            $overdueRepairsCount = $overdueRepairs->count();
                        }
                    }
                    $view->with('overdueRepairs', $overdueRepairs);
                    $view->with('overdueRepairsCount', $overdueRepairsCount);
                    $view->with('userRepairs', $userRepairs);
                    $view->with('scheduledRepairsCount', $scheduledRepairsCount);
                });
            }
        }
    }
}
