<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ShipmentController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::middleware('auth:sanctum')
        ->post('logout', [AuthController::class, 'logout']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('shipments/price', [ShipmentController::class, 'shippingPriceCalculation']);
    Route::resource('shipments', ShipmentController::class);

});
