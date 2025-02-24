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
use App\Http\Controllers\AssetController;

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

        Route::get('/aset', [AssetController::class, 'index'])->name('aset.aset'); // Menampilkan semua asset
        Route::post('/assets/{id}/update-status', [AssetController::class, 'updateStatus'])->name('assets.updateStatus');
        Route::post('/assets/update-description/{id}', [AssetController::class, 'updateDescription']);
        Route::get('/aset/create', [AssetController::class, 'create'])->name('aset.aset_create'); // Menampilkan form tambah asset
        Route::post('/aset/store', [AssetController::class, 'store']); // Menyimpan asset baru
        Route::put('/assets/{id}/update', [AssetController::class, 'update'])->name('assets.update');
        Route::delete('/assets/{asset}', [AssetController::class, 'destroy'])->name('assets.destroy'); // Menghapus asset
    });


    Route::get('/profile', [UserController::class, 'profile']);
    Route::post('/upload-profile', [UserController::class, 'post_profile'])->name('upload.image');

    Route::put('/history/dashboard-update', [DashboardController::class, 'updateHistoryDashboard'])->name('history.dashboard.update');
    Route::put('/order/update-status', [DashboardController::class, 'updateStatus'])->name('order-items.updateStatus');

    Route::put('/order/update-items-dashboard', [DashboardController::class, 'updateItemsDashboard'])->name('order-items.dashboard');



    Route::patch('/revised/{id}', [InventoryController::class, 'revised']);
    Route::get('/item', [InventoryController::class, 'index']);
    Route::post('/save', [SaveController::class, 'store']);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('home');
    Route::get('/logout', [AuthController::class, 'logout']);

    Route::post('/update-order-items', [DashboardController::class, 'updateOrderItems'])->name('update.items');
    Route::post('/update-order-items-status', [DashboardController::class, 'updateOrderItemsStatus'])->name('update.items');


    Route::get('/fetch-orders/{filter}', [RekapitulasiController::class, 'fetchOrders'])->name('orders.fetch');
});
