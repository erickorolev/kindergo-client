<?php

declare(strict_types=1);

namespace Domains\Timetables\Services;

use Domains\Attendants\Models\Attendant;
use Domains\Children\Models\Child;
use Domains\Users\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Support\VtigerClient\WSException;

final class TimetableConnector extends \Parents\Services\ConnectorService
{
    public function receive(): Collection
    {
        $result = collect([]);

        try {
            $timetables = $this->client->entities?->findMany('Timetable', [
                'modifiedtime' => Carbon::now()->subDay()->format('Y-m-d')
            ]);
        } catch (WSException $e) {
            Log::error('Error in getting timetable data from Vtiger: ' . $e->getMessage());
            app('sentry')->captureException($e);
            $timetables = null;
        }

        if (!$timetables) {
            return $result;
        }

        foreach ($timetables as $timetable) {
            $result->push($this->getChildrenToCollection($timetable));
        }

        return $result;
    }

    protected function getChildrenToCollection(array $timetable): Collection
    {
        $timetable['children'] = [
            $timetable['cf_nrl_contacts759_id'],
            $timetable['cf_nrl_contacts296_id'],
            $timetable['cf_nrl_contacts85_id'],
            $timetable['cf_nrl_contacts705_id'],
        ];
        return collect($timetable);
    }
}
