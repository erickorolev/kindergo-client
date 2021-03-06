<?php

namespace App\Providers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\ServiceProvider;
use Parents\Foundation\Portal;
use Spatie\Fractal\Facades\Fractal;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind('Portal', function (): Portal {
            return new Portal();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     * @psalm-suppress UndefinedMethod
     * @psalm-suppress MixedReturnStatement
     * @psalm-suppress MixedInferredReturnType
     */
    public function boot(): void
    {
        Fractal::macro('respondJsonApi', function (
            int $statusCode = 200,
            array $headers = []
        ): JsonResponse {
            return $this->respond($statusCode, array_merge($headers, [
                'Content-Type' => 'application/vnd.api+json',
            ]));
        });
    }
}
