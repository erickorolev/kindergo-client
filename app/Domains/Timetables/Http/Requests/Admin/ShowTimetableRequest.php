<?php

declare(strict_types=1);

namespace Domains\Timetables\Http\Requests\Admin;

use Parents\Requests\Request;

final class ShowTimetableRequest extends Request
{
    public function rules(): array
    {
        return [
            //
        ];
    }

    public function authorize(): bool
    {
        return $this->check('view timetables');
    }
}
