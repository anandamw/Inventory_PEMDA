<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\SaveController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
        Route::post('/user/store', [UserController::class, 'store']);
        Route::get('/user', [UserController::class, 'index']);
    });

                Route::post('/upload-profile', [SaveController::class, 'post_profile'])->name('upload.image');
    Route::get('/item', [InventoryController::class, 'index']);
    Route::post('/save', [SaveController::class, 'store']);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('home');
    Route::get('/logout', [AuthController::class, 'logout']);
});
