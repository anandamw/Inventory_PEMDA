<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SaveController;
use App\Http\Controllers\UserController;
// routes/web.php
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\AssetController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\RepairController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\InstansiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\RekapitulasiController;
use App\Models\RepairTeam;

Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'index'])->name('login');
        Route::post('/scan-qr-code', [AuthController::class, 'scanQrCode'])->name('scanQrCode');
        Route::get('/qrcode', [QrCodeController::class, 'index']);
        Route::post('/register/action', [AuthController::class, 'register_action'])->name('register_action');
        Route::get('/instansi/search', [InstansiController::class, 'search']);
});

// auth middleware
Route::middleware(['auth'])->group(function () {


        Route::get('/', [AuthController::class, 'permission']);

        Route::middleware(['role:admin'])->group(function () {
                Route::get('/dashboard', [DashboardController::class, 'index'])->name('home');
                Route::get('/history', [HistoryController::class, 'index']);

                Route::get('/item/create', [InventoryController::class, 'create'])->name('item.item_create');

                Route::get('/inventory', [InventoryController::class, 'index']);

                Route::post('/inventory/store', [InventoryController::class, 'store']);
                Route::put('/inventory/{id_inventories}/update', [InventoryController::class, 'update']);
                Route::delete('/inventory/{id_inventories}/destroy', [InventoryController::class, 'destroy'])->name('inventory.destroy');

                Route::get('/user', [UserController::class, 'index']);
                Route::put('/user/{id}/update', [UserController::class, 'update'])->name('user.update');
                Route::delete('/user/{id}/destroy', [UserController::class, 'destroy'])->name('users.destroy');
                Route::post('/user/store', [UserController::class, 'store']);
                Route::get('/user/check-duplicate', [UserController::class, 'checkDuplicate']);

                Route::get('/autocomplete-instansi', [InstansiController::class, 'autocomplete']);
                Route::get('/instansi', [InstansiController::class, 'index'])->name('instansi.instansi');
                Route::post('/instansi', [InstansiController::class, 'store'])->name('instansi.store');
                Route::put('/instansi/{id_instansi}/update', [InstansiController::class, 'update'])->name('instansi.update');
                Route::delete('/instansi/{id}/destroy', [InstansiController::class, 'destroy'])->name('instansi.destroy');


                Route::get('/rekapitulasi', [RekapitulasiController::class, 'index'])->name('rekapitulasi.rekapitulasi');
                Route::get('/rekapitulasi/{id}', [RekapitulasiController::class, 'show'])->name('rekapitulasi.show');
                Route::get('/rekapitulasi/download/{id}', [RekapitulasiController::class, 'downloadPdf'])->name('rekapitulasi.download');


                Route::get('/aset', [AssetController::class, 'index'])->name('aset.aset'); // Menampilkan semua asset
                Route::post('/assets/{id}/update-status', [AssetController::class, 'updateStatus'])->name('assets.updateStatus');
                Route::post('/assets/update-description/{id}', [AssetController::class, 'updateDescription']);
                Route::post('/aset/store', [AssetController::class, 'store']); // Menyimpan asset baru
                Route::put('/assets/{id}/update', [AssetController::class, 'update'])->name('assets.update');
                Route::delete('/assets/{asset}', [AssetController::class, 'destroy'])->name('assets.destroy'); // Menghapus asset
                // Menampilkan daftar perbaikan
                Route::get('/perbaikan', [RepairController::class, 'index']);



                Route::post('/repair/schedule/{id}', [DashboardController::class, 'scheduleRepair'])->name('repair.schedule');
                Route::get('/repair/complete/{id}', [DashboardController::class, 'complete']);

                Route::get('/repair/delete/{id}', [DashboardController::class, 'deleteRepair'])->name('repair.delete');
                Route::put('/history/dashboard-update', [DashboardController::class, 'updateHistoryDashboard'])->name('history.dashboard.update');
                Route::put('/order/update-status', [DashboardController::class, 'updateStatus'])->name('order-items.updateStatus');
                Route::get('/admin/item', [InventoryController::class, 'index']);
                Route::put('/admin/order/update-items-dashboard', [DashboardController::class, 'updateItemsDashboard'])->name('order-items.dashboard');
                Route::post('/admin/save', [SaveController::class, 'store']);
                Route::post('/admin/update-order-items', [DashboardController::class, 'updateOrderItems'])->name('update.items');
                Route::post('/admin/update-order-items-status', [DashboardController::class, 'updateOrderItemsStatus'])->name('update.items');
                Route::get('/fetch-orders/{filter}', [RekapitulasiController::class, 'fetchOrders'])->name('orders.fetch');
        });


        Route::middleware(['role:opd'])->group(function () {
                Route::post('/repair/store', [DashboardController::class, 'storeRepair'])->name('repair.store');
                Route::get('/Home', [DashboardController::class, 'opdDashboard'])->name('opdhome');
                Route::post('/update-rating-comment', [RatingController::class, 'addrating'])->name('update.rating.comment');
        });

        Route::middleware(['role:team'])->group(function () {
                Route::get('/team/dashboard', [DashboardController::class, 'index'])->name('teamHome');
                Route::get('/item', [InventoryController::class, 'index']);
                Route::put('/order/update-items-dashboard', [DashboardController::class, 'updateItemsDashboard'])->name('order-items.dashboard');
                Route::post('/save', [SaveController::class, 'store']);
                Route::post('/update-order-items', [DashboardController::class, 'updateOrderItems'])->name('update.items');
                Route::post('/update-order-items-status', [DashboardController::class, 'updateOrderItemsStatus'])->name('update.items');
                Route::post('/mark-notification-completed/{repairId}', [DashboardController::class, 'markCompleted']);
        });

        Route::post('/repairs/{id}/assign', [DashboardController::class, 'assignToTeam'])->name('repairs.assign');
        Route::post('/repairs/{id}/complete', [DashboardController::class, 'complete'])->name('repairs.complete');


        Route::get('/profile', [UserController::class, 'profile']);
        Route::post('/upload-profile', [UserController::class, 'post_profile'])->name('upload.image');


        Route::get('/logout', [AuthController::class, 'logout']);
});
