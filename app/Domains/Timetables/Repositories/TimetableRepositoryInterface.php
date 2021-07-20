<?php

declare(strict_types=1);

namespace Domains\Timetables\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;
use Parents\Models\Model;

interface TimetableRepositoryInterface
{
    public function basicPaginate(string $search, int $pagination): LengthAwarePaginator;

    public function jsonPaginate(): LengthAwarePaginator;

    public function findJson(int $id): Model;
}
