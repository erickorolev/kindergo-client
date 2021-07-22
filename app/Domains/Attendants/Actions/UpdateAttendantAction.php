<?php

declare(strict_types=1);

namespace Domains\Attendants\Actions;

use Domains\Attendants\DataTransferObjects\AttendantData;
use Domains\Attendants\Models\Attendant;
use Support\Media\Tasks\UpdateImagesTask;

final class UpdateAttendantAction extends \Parents\Actions\Action
{
    public function handle(AttendantData $data): Attendant
    {
        /** @var Attendant $attendant */
        $attendant = GetAttendantByIdAction::run($data->id);
        $attendant->update($data->toArray());
        UpdateImagesTask::run($attendant, $data);
        return $attendant;
    }
}
