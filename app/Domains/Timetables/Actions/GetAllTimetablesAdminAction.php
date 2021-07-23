<?php

declare(strict_types=1);

namespace Domains\Timetables\Actions;

use Domains\Timetables\Repositories\TimetableRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

final class GetAllTimetablesAdminAction extends \Parents\Actions\Action
{
    public function __construct(
        protected TimetableRepositoryInterface $repository
    ) {
    }

    public function handle(string $search = '', int $paginate = 5): LengthAwarePaginator
    {
        return $this->repository->basicPaginate($search, $paginate);
    }
}
