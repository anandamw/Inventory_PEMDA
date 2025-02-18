<?php

namespace App\Providers;

use App\Http\Middleware\UpdateLastSeen;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\Facades\View;
use App\Models\Inventory;

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
         // Hanya mengambil item dengan stok kurang dari 10
         $lowStockItems = Inventory::where('quantity', '<', 10)
             ->select('code_item', 'item_name', 'img_item', 'quantity')
             ->get();
 
         // Hitung jumlah item dengan stok rendah
         $lowStockCount = $lowStockItems->count();
 
         // Share data ke semua view
         View::share('lowStockCount', $lowStockCount);
         View::share('lowStockItems', $lowStockItems); // Ganti dari dataItem ke lowStockItems
     }
}
