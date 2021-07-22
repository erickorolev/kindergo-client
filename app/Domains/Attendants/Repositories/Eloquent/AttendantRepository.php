<?php

declare(strict_types=1);

namespace Domains\Attendants\Repositories\Eloquent;

use Domains\Attendants\Models\Attendant;
use Domains\Attendants\Repositories\AttendantRepositoryInterface;
use \Parents\Repositories\Repository;
use \Illuminate\Pagination\LengthAwarePaginator;

final class AttendantRepository extends Repository implements AttendantRepositoryInterface
{
    public function basicPaginate(string $search, int $pagination = 5): LengthAwarePaginator
    {
        return Attendant::search($search)
            ->latest()
            ->paginate($pagination);
    }
}
