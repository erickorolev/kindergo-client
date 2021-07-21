<?php

declare(strict_types=1);

namespace Domains\Timetables\Actions;

use Domains\Timetables\Repositories\TimetableRepositoryInterface;
use Parents\Criterias\Eloquent\ThisUserCriteria;

final class GetTimetablesAction extends \Parents\Actions\Action
{
    public function __construct(
        protected TimetableRepositoryInterface $repository
    )
    {
    }

    public function handle(): \Illuminate\Pagination\LengthAwarePaginator
    {
        return $this->repository->pushCriteria(new ThisUserCriteria())->jsonPaginate();
    }
}
