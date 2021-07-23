<?php

declare(strict_types=1);

namespace Domains\Attendants\Actions;

use Domains\Attendants\Repositories\AttendantRepositoryInterface;

final class GetAllAttendantAction extends \Parents\Actions\Action
{
    public function __construct(
        protected AttendantRepositoryInterface $repository
    ) {
    }

    public function handle(): \Illuminate\Pagination\LengthAwarePaginator
    {
        return $this->repository->jsonPaginate();
    }
}
