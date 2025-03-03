<?php

namespace App\Providers;

use App\Models\Asset; 
use App\Models\Repair;
use App\Models\Inventory;
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
    
                    if (auth()->check()) {
                        $userRepairs = Repair::where('user_id', auth()->id())
                            ->with('admin')
                            ->orderBy('scheduled_date', 'desc')
                            ->get();
    
                        $scheduledRepairsCount = $userRepairs->where('status', 'scheduled')->count();
                    }
    
                    $view->with('userRepairs', $userRepairs);
                    $view->with('scheduledRepairsCount', $scheduledRepairsCount);
                });
            }
    
     }
}
}
