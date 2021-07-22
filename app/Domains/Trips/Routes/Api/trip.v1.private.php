<?php

/**
 * @routeNamespace("Domains\Trips\Http\Controllers\Api")
 * @routePrefix("api.")
 */

Route::get('trips/{id}/{relation}', [
    \Domains\Payments\Http\Controllers\Api\PaymentApiController::class,
    'relations'
])->name('trips.relations');
Route::post('trips/{id}/{relation}/{parent}', [
    \Domains\Payments\Http\Controllers\Api\PaymentApiController::class,
    'relationCreate'
])->name('trips.relations.create');
Route::apiResource('trips', \Domains\Payments\Http\Controllers\Api\PaymentApiController::class);
