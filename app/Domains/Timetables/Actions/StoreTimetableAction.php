<?php

declare(strict_types=1);

namespace Domains\Timetables\Actions;

use Domains\Timetables\DataTransferObjects\TimetableData;
use Domains\Timetables\Models\Timetable;

final class StoreTimetableAction extends \Parents\Actions\Action
{
    public function handle(TimetableData $data): Timetable
    {
        $timetable = Timetable::create($data->toArray());
        $timetable->children()->attach($data->children);
        return $timetable;
    }
}
