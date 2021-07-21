<?php

declare(strict_types=1);

namespace Parents\Middlewares\Http;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

final class IsAdmin extends \Parents\Middlewares\Middleware
{
    public function handle(Request $request, Closure $next): mixed
    {
        if (Auth::user()->hasAnyRole(['user', 'super-admin'])) {
            return $next($request);
        } else {
            abort(403);
        }
    }
}
