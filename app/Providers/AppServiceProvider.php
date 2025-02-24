<?php

namespace App\Providers;

use App\Http\Middleware\UpdateLastSeen;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\Facades\View;
use App\Models\Inventory;
use App\Models\Asset; 

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
