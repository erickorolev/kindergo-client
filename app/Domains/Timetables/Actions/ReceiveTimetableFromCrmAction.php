<?php

declare(strict_types=1);

namespace Domains\Timetables\Actions;

use Domains\Timetables\DataTransferObjects\TimetableData;
use Domains\Timetables\Models\Timetable;
use Domains\Timetables\Services\TimetableConnector;

final class ReceiveTimetableFromCrmAction extends \Parents\Actions\Action
{
    public function handle(int $id): Timetable
    {
        $service = app(TimetableConnector::class);
        $crmTimetable = $service->receiveById('Timetable', $id);
        $timetableData = TimetableData::fromConnector($crmTimetable);
        $existingTimetable = GetTimetableByCrmIdAction::run($timetableData->crmid);
        if ($existingTimetable) {
            $timetableData->id = $existingTimetable->id;
            /** @var Timetable $timetable */
            $timetable = UpdateTimetableAction::run($timetableData);
        } else {
            /** @var Timetable $timetable */
            $timetable = StoreTimetableAction::run($timetableData);
        }
        return $timetable;
    }
}
