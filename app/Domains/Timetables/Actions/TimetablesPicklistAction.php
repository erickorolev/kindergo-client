<?php

declare(strict_types=1);

namespace Domains\Timetables\Actions;

use Domains\Timetables\Models\Timetable;
use Illuminate\Support\Collection;

final class TimetablesPicklistAction extends \Parents\Actions\Action
{
    public function handle(): Collection
    {
        return Timetable::all()->pluck('name', 'id');
    }
}
