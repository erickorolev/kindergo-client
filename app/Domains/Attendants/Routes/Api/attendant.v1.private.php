<?php

/**
 * @routeNamespace("Domains\Attendants\Http\Controllers\Api")
 * @routePrefix("api.")
 */

Route::get('attendants/{id}/{relation}', [
    \Domains\Attendants\Http\Controllers\Api\AttendantApiController::class,
    'relations'
])->name('attendants.relations');
Route::post('attendants/{id}/{relation}/{parent}', [
    \Domains\Attendants\Http\Controllers\Api\AttendantApiController::class,
    'relationCreate'
])->name('attendants.relations.create');
Route::apiResource(
    'attendants',
    \Domains\Attendants\Http\Controllers\Api\AttendantApiController::class
);
