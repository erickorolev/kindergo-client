<?php

declare(strict_types=1);

namespace Domains\Attendants\Actions;

use Domains\Attendants\DataTransferObjects\AttendantData;
use Domains\Attendants\Models\Attendant;
use Domains\Attendants\Services\AttendantConnector;

final class ReceiveAttendantFromCrmAction extends \Parents\Actions\Action
{
    public function handle(int $id): Attendant
    {
        $service = app(AttendantConnector::class);
        $crmUser = $service->receiveById('Contacts', $id);
        $attendantData = AttendantData::fromConnector($crmUser);
        $existingUser = GetAttendantByCrmIdAction::run($attendantData->crmid);
        if ($existingUser) {
            $attendantData->id = $existingUser->id;
            /** @var Attendant $attendant */
            $attendant = UpdateAttendantAction::run($attendantData, false);
        } else {
            /** @var Attendant $attendant */
            $attendant = StoreAttendantAction::run($attendantData, false);
        }
        return $attendant;
    }
}
