<?php

declare(strict_types=1);

namespace Domains\Attendants\Actions;

use Domains\Attendants\DataTransferObjects\AttendantData;
use Domains\Attendants\Jobs\SendAttendantToVtigerJob;
use Domains\Attendants\Models\Attendant;
use Support\Media\Tasks\AttachImagesTask;

final class StoreAttendantAction extends \Parents\Actions\Action
{
    public function handle(AttendantData $data, bool $doDispatch = true): Attendant
    {
        $attendant = Attendant::create($data->toArray());
        AttachImagesTask::run($attendant, $data);
        if ($doDispatch) {
            SendAttendantToVtigerJob::dispatch($attendant);
        }
        return $attendant;
    }
}
