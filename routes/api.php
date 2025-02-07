<?php

use App\Http\Controllers\api\SaveController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// auth middleware 


// Route::post('/save', [SaveController::class, 'index']);
