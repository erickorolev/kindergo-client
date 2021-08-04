<?php

declare(strict_types=1);

namespace Domains\Timetables\Console\Commands;

use Domains\Timetables\Actions\GetTimetableByCrmIdAction;
use Domains\Timetables\Actions\StoreTimetableAction;
use Domains\Timetables\Actions\UpdateTimetableAction;
use Domains\Timetables\DataTransferObjects\TimetableData;
use Domains\Timetables\Models\Timetable;
use Domains\Timetables\Services\TimetableConnector;
use Illuminate\Support\Facades\Log;
use Parents\Commands\Command;

final class GetTimetablesFromVtigerCommand extends Command
{
    protected $signature = 'timetables:receive';

    protected $description = 'Import timetables data from Vtiger';

    public function handle(): int
    {
        $connector = app(TimetableConnector::class);
        $timetables = $connector->receive();
        foreach ($timetables as $timetable) {
            try {
                $timetableData = TimetableData::fromConnector($timetable);
                $existingTimetable = GetTimetableByCrmIdAction::run($timetableData->crmid);
                if ($existingTimetable) {
                    $timetableData->id = $existingTimetable->id;
                    UpdateTimetableAction::run($timetableData);
                } else {
                    StoreTimetableAction::run($timetableData);
                }
            } catch (\Exception $e) {
                Log::error('Failed to save Timetable data from Vtiger in DB for '
                    . $timetable['id'] . ': '
                    . $e->getMessage());
                app('sentry')->captureException($e);
                continue;
            }
        }
        return 0;
    }
}
