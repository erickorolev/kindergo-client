<?php

declare(strict_types=1);

namespace Domains\Timetables\Http\Requests;

use Parents\Requests\Request;

final class CreateTimetableRequest extends Request
{
    public function rules(): array
    {
        return [
            //
        ];
    }

    public function authorize(): bool
    {
        return $this->check('create timetables');
    }
}
