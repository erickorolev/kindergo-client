<?php

declare(strict_types=1);

namespace Domains\Timetables\Actions;

use Domains\Attendants\Models\Attendant;
use Domains\Timetables\Models\Timetable;
use Parents\ValueObjects\CrmIdValueObject;

final class GetClearTimetableIdAction extends \Parents\Actions\Action
{
    public function handle(int|string|null $id): ?int
    {
        if ($id === null) {
            return null;
        }
        try {
            $crmid = CrmIdValueObject::fromNative((string) $id);
            /** @var ?Timetable $user */
            $user = GetTimetableByCrmIdAction::run($crmid);
            return $user?->id;
        } catch (\InvalidArgumentException $ex) {
            /** @var Timetable $user */
            $user = GetTimetableByIdAction::run((int) $id);
            return $user->id;
        }
    }
}
