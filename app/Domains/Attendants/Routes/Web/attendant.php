<?php

/**
 * @routeNamespace("Domains\Attendants\Http\Controllers\Admin")
 * @routePrefix("admin.")
 */

Route::resource('attendants', \Domains\Attendants\Http\Controllers\Admin\AttendantController::class);
