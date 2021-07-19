<?php
/**
 * @routeNamespace("Domains\Users\Http\Controllers\Api")
 * @routePrefix("api.")
 */

use Domains\Users\Http\Controllers\Api\UserApiController;

\Illuminate\Support\Facades\Route::get('users/me', [
    UserApiController::class,
    'me'
])->name('users.me');
Route::apiResource('users', UserApiController::class);
