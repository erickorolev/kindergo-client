<?php

use Domains\Timetables\Http\Controllers\Admin\TimetableController;

/**
 * @routeNamespace("Domains\Timetables\Http\Controllers\Admin")
 * @routePrefix("admin.")
 */

Route::resource('timetables', TimetableController::class);
