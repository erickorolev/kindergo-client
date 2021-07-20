<?php

declare(strict_types=1);

namespace Domains\Timetables\Actions;

use Domains\Timetables\DataTransferObjects\TimetableData;
use Domains\Timetables\Models\Timetable;

final class UpdateTimetableAction extends \Parents\Actions\Action
{
    public function handle(TimetableData $data): Timetable
    {
        /** @var Timetable $timetable */
        $timetable = GetTimetableByIdAction::run($data->id);
        $timetable->update($data->toArray());
        return $timetable;
    }
}
