<?php

declare(strict_types=1);

namespace Domains\Attendants\Console\Commands;

use Domains\Attendants\Actions\GetAttendantByCrmIdAction;
use Domains\Attendants\Actions\StoreAttendantAction;
use Domains\Attendants\Actions\UpdateAttendantAction;
use Domains\Attendants\DataTransferObjects\AttendantData;
use Domains\Attendants\Models\Attendant;
use Domains\Attendants\Services\AttendantConnector;
use Domains\Users\Actions\GetUserByCrmidAction;
use Domains\Users\Actions\StoreUserAction;
use Domains\Users\Actions\UpdateUserAction;
use Domains\Users\DataTransferObjects\UserData;
use Domains\Users\Models\User;
use Illuminate\Support\Facades\Log;
use Parents\Commands\Command;

final class GetAttendantsFromVtigerCommand extends Command
{
    protected $signature = 'attendants:receive';

    protected $description = 'Import attendants from Vtiger';

    public function handle(): int
    {
        $connector = app(AttendantConnector::class);
        $attendants = $connector->receive();
        foreach ($attendants as $attendant) {
            try {
                $attendantData = AttendantData::fromConnector($attendant);
                $existingUser = GetAttendantByCrmIdAction::run($attendantData->crmid);
                if ($existingUser) {
                    $attendantData->id = $existingUser->id;
                    UpdateAttendantAction::run($attendantData, false);
                } else {
                    StoreAttendantAction::run($attendantData, false);
                }
            } catch (\Exception $e) {
                Log::error('Failed to save Attendant data from Vtiger in DB for '
                    . $attendant['id'] . ': '
                    . $e->getMessage());
                app('sentry')->captureException($e);
                continue;
            }
        }
        return 0;
    }
}
