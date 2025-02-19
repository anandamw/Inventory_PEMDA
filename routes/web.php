<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SaveController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QrCodeController;
 use App\Http\Controllers\HistoryController;
// routes/web.php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\RekapitulasiController;

Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::post('/scan-qr-code', [AuthController::class, 'scanQrCode'])->name('scanQrCode');
    Route::get('/qrcode', [QrCodeController::class, 'index']);
});  

// auth middleware
Route::middleware(['auth'])->group(function () {

    Route::middleware(['role:admin'])->group(function () {

        Route::get('/history', [HistoryController::class, 'index']);
        
        Route::get('/item/create', [InventoryController::class, 'create'])->name('item.item_create');

        Route::get('/inventory', [InventoryController::class, 'index']);

        Route::post('/inventory/store', [InventoryController::class, 'store']);
        Route::put('/inventory/{id_inventories}/update', [InventoryController::class, 'update']);
        Route::get('/inventory/{id}/destroy', [InventoryController::class, 'destroy']);
        Route::get('/user/create', [UserController::class, 'create']);
        Route::get('/user/{id}/edit', [UserController::class, 'edit']);
        Route::post('/user/{id}/update', [UserController::class, 'update']);
        Route::get('/user/{id}/destroy', [UserController::class, 'destroy']);
        Route::post('/user/store', [UserController::class, 'store']);
        Route::get('/user', [UserController::class, 'index']);

        Route::get('/rekapitulasi', [RekapitulasiController::class, 'index'])->name('rekapitulasi.rekapitulasi');      
        Route::get('/rekapitulasi/{id}', [RekapitulasiController::class, 'show'])->name('rekapitulasi.show');
        Route::get('/rekapitulasi/download/{id}', [RekapitulasiController::class, 'downloadPdf'])->name('rekapitulasi.download');  

        
    });
    Route::get('/profile', [UserController::class, 'profile']);
    Route::post('/upload-profile', [UserController::class, 'post_profile'])->name('upload.image');

    Route::put('/history/dashboard-update', [DashboardController::class, 'updateHistoryDashboard'])->name('history.dashboard.update');
    Route::put('/order/update-status', [DashboardController::class, 'updateStatus'])->name('order-items.updateStatus');

    Route::patch('/revised/{id}', [InventoryController::class, 'revised']);
    Route::get('/item', [InventoryController::class, 'index']);
    Route::post('/save', [SaveController::class, 'store']);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('home');
    Route::get('/logout', [AuthController::class, 'logout']);

   

Route::get('/fetch-orders/{filter}', [RekapitulasiController::class, 'fetchOrders'])->name('orders.fetch');

});
