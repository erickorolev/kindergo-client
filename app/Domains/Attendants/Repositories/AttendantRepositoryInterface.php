<?php

declare(strict_types=1);

namespace Domains\Attendants\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;
use Parents\Models\Model;

interface AttendantRepositoryInterface
{
    public function basicPaginate(string $search, int $pagination): LengthAwarePaginator;

    public function jsonPaginate(): LengthAwarePaginator;

    public function findJson(int $id): Model;
}
