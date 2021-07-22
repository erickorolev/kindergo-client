<?php

declare(strict_types=1);

namespace Domains\Attendants\Actions;

use Domains\Attendants\Models\Attendant;

final class DeleteAttendantAction extends \Parents\Actions\Action
{
    public function handle(int $id): bool
    {
        /** @var Attendant $attendant */
        $attendant = GetAttendantByIdAction::run($id);
        $attendant->delete();
        return true;
    }
}
