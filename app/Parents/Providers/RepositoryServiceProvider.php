<?php

declare(strict_types=1);

namespace Parents\Providers;

use Domains\Children\Repositories\ChildRepositoryInterface;
use Domains\Children\Repositories\Eloquent\ChildRepository;
use Domains\TemporaryFile\Models\TemporaryFile;
use Domains\TemporaryFile\Repositories\Eloquent\TemporaryFileRepository;
use Domains\TemporaryFile\Repositories\TemporaryFileRepositoryInterface;
use Domains\Users\Repositories\Eloquent\UserRepository;
use Domains\Users\Repositories\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(ChildRepositoryInterface::class, ChildRepository::class);
        $this->app->bind(TemporaryFileRepositoryInterface::class, TemporaryFileRepository::class);
    }
}
