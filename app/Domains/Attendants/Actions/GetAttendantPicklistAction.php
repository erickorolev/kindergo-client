<?php

declare(strict_types=1);

namespace Domains\Attendants\Actions;

use Domains\Attendants\Models\Attendant;
use Illuminate\Support\Collection;

final class GetAttendantPicklistAction extends \Parents\Actions\Action
{
    public function handle(): Collection
    {
        return Attendant::all()->pluck('firstname', 'id');
    }
}
