<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\SaveController;
use App\Http\Controllers\UserController;
use App\Models\User;

// Removed redundant route definition for '/dashboard'


Route::middleware('guest')->group(function () {

    Route::get('/', function () {

        $data = User::all();

        return response()->json([
            'data' => $data
        ]);
    });
    // Route::post('/login', [AuthController::class, 'login']);

    Route::get('/test', [AuthController::class, 'index'])->name('login');
    Route::post('/scan-qr-code', [AuthController::class, 'scanQrCode'])->name('scanQrCode');
    Route::get('/qrcode', [QrCodeController::class, 'index']);
});



// auth middleware 
Route::middleware(['auth'])->group(function () {


    Route::post('/save', [SaveController::class, 'save']);
    Route::get('/user', [UserController::class, 'index']);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('home');
    Route::get('/item', [InventoryController::class, 'index']);
    Route::get('/inventory', [InventoryController::class, 'index']);
    Route::post('/inventory/store', [InventoryController::class, 'store']);
    Route::post('/inventory/{id}/update', [InventoryController::class, 'update']);
    Route::get('/inventory/{id}/destroy', [InventoryController::class, 'destroy']);

    Route::get('/logout', [AuthController::class, 'logout']);
});
// haii 