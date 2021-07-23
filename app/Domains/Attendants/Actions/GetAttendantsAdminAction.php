<?php

declare(strict_types=1);

namespace Domains\Attendants\Actions;

use Domains\Attendants\Repositories\AttendantRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

final class GetAttendantsAdminAction extends \Parents\Actions\Action
{
    public function __construct(
        protected AttendantRepositoryInterface $repository
    ) {
    }

    public function handle(string $search = '', int $pagination = 5): LengthAwarePaginator
    {
        return $this->repository->basicPaginate($search, $pagination);
    }
}
