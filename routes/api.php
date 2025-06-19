<?php

use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('login', [App\Http\Controllers\Auth\AuthController::class, 'login']);
    Route::middleware('auth:sanctum')
        ->post('logout', [App\Http\Controllers\Auth\AuthController::class, 'logout']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('shipments/price', [App\Http\Controllers\ShipmentController::class, 'shippingPriceCalculation']);
    Route::resource('shipments', App\Http\Controllers\ShipmentController::class);

});
