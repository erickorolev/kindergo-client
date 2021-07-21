<?php

declare(strict_types=1);

namespace Domains\Timetables\Actions;

use Domains\Timetables\Models\Timetable;

final class DeleteTimetableAction extends \Parents\Actions\Action
{
    public function handle(int $id): bool
    {
        /** @var Timetable $timetable */
        $timetable = GetTimetableByIdAction::run($id);
        $timetable->delete();
        return true;
    }
}
