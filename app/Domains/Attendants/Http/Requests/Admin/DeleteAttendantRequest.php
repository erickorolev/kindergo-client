<?php

declare(strict_types=1);

namespace Domains\Attendants\Http\Requests\Admin;

use Parents\Requests\Request;

final class DeleteAttendantRequest extends Request
{
    public function rules(): array
    {
        return [
            //
        ];
    }

    public function authorize(): bool
    {
        return $this->check('delete attendants');
    }
}
