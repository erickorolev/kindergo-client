<?php

declare(strict_types=1);

namespace Domains\Timetables\Actions;

use Domains\Timetables\Models\Timetable;
use Domains\Timetables\Repositories\TimetableRepositoryInterface;

final class GetTimetableByIdAction extends \Parents\Actions\Action
{
    public function __construct(
        protected TimetableRepositoryInterface $repository
    ) {
    }

    public function handle(int $id): Timetable
    {
        /** @var Timetable $timetable */
        $timetable = $this->repository->findJson($id);
        return $timetable;
    }
}
