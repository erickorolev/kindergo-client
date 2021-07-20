<?php

declare(strict_types=1);

namespace Domains\Timetables\Repositories\Eloquent;

use Domains\Timetables\Models\Timetable;
use Illuminate\Pagination\LengthAwarePaginator;
use \Parents\Repositories\Repository;
use \Domains\Timetables\Repositories\TimetableRepositoryInterface;

final class TimetableRepository extends Repository implements TimetableRepositoryInterface
{

    public function basicPaginate(string $search, int $pagination = 5): LengthAwarePaginator
    {
        return Timetable::search($search)
            ->latest()
            ->paginate($pagination);
    }
}
