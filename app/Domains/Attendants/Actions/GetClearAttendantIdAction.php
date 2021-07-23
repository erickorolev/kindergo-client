<?php

declare(strict_types=1);

namespace Domains\Attendants\Actions;

use Domains\Attendants\Models\Attendant;
use Parents\ValueObjects\CrmIdValueObject;

final class GetClearAttendantIdAction extends \Parents\Actions\Action
{
    public function handle(int|string|null $id): ?int
    {
        if ($id === null) {
            return null;
        }
        try {
            $crmid = CrmIdValueObject::fromNative((string) $id);
            /** @var ?Attendant $user */
            $user = GetAttendantByCrmIdAction::run($crmid);
            return $user?->id;
        } catch (\InvalidArgumentException $ex) {
            /** @var Attendant $user */
            $user = GetAttendantByIdAction::run($id);
            return $user->id;
        }
    }
}
