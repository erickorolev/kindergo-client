<?php

declare(strict_types=1);

namespace Domains\Attendants\Actions;

use Domains\Attendants\Models\Attendant;
use Parents\ValueObjects\CrmIdValueObject;

final class GetAttendantByCrmIdAction extends \Parents\Actions\Action
{
    public function handle(CrmIdValueObject $crmid): ?Attendant
    {
        return Attendant::where('crmid', $crmid->toNative())->first();
    }
}
