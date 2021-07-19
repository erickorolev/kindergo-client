<?php

declare(strict_types=1);

namespace Domains\Users\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    public function jsonPaginate(): LengthAwarePaginator;

    public function findJson(int $id): Model;
}
