<?php

declare(strict_types=1);

namespace Domains\Timetables\Actions;

use Domains\Timetables\Models\Timetable;
use Parents\ValueObjects\CrmIdValueObject;

final class GetTimetableByCrmIdAction extends \Parents\Actions\Action
{
    public function handle(CrmIdValueObject $crmid): ?Timetable
    {
        return Timetable::where('crmid', $crmid->toNative())->first();
    }
}
