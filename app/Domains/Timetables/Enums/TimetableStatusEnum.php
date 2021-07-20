<?php

declare(strict_types=1);

namespace Domains\Timetables\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;

final class TimetableStatusEnum extends \Parents\Enums\Enum implements LocalizedEnum
{
    public const PENDING = 'Pending';

    public const PERFORMED = 'Performed';

    public const COMPLETED = 'Completed';

    public const CANCELED = 'Canceled';
}
