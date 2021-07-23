<?php

/**
 * @routeNamespace("Domains\Timetables\Http\Controllers\Admin")
 * @routePrefix("admin.")
 */

use Domains\Timetables\Http\Controllers\Admin\TimetableController;

Route::resource('timetables', TimetableController::class);
