<?php

declare(strict_types=1);

namespace Domains\Children\Http\Requests\Admin;

use Parents\Requests\Request;

final class ShowChildRequest extends Request
{
    public function rules(): array
    {
        return [
            //
        ];
    }

    public function authorize(): bool
    {
        return $this->check('view children');
    }
}
