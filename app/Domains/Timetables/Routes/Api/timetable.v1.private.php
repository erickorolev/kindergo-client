<?php

/**
 * @routeNamespace("Domains\Timetables\Http\Controllers\Api")
 * @routePrefix("api.")
 */

Route::get('timetables/{id}/{relation}', [
    \Domains\Timetables\Http\Controllers\Api\TimetableApiController::class,
    'relations'
])->name('timetables.relations');
Route::post('timetables/{id}/{relation}/{parent}', [
    \Domains\Timetables\Http\Controllers\Api\TimetableApiController::class,
    'relationCreate'
])->name('timetables.relations.create');
Route::apiResource('timetables', \Domains\Timetables\Http\Controllers\Api\TimetableApiController::class);
