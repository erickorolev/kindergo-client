<?php

declare(strict_types=1);

namespace Domains\Attendants\Actions;

use Domains\Attendants\Models\Attendant;

final class GetAttendantByIdAction extends \Parents\Actions\Action
{
    public function handle(int $id): Attendant
    {
        /** @var Attendant $attendant */
        $attendant = Attendant::whereId($id)->firstOrFail();
        return $attendant;
    }
}
