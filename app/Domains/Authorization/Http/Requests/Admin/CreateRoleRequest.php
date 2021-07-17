<?php

declare(strict_types=1);

namespace Domains\Authorization\Http\Requests\Admin;

use Parents\Requests\Request;

final class CreateRoleRequest extends Request
{
    public function rules(): array
    {
        return [
            //
        ];
    }

    public function authorize(): bool
    {
        return $this->check('create roles');
    }
}
