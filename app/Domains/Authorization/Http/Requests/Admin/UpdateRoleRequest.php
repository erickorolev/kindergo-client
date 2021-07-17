<?php

declare(strict_types=1);

namespace Domains\Authorization\Http\Requests\Admin;

use Laravel\Sanctum\Sanctum;
use Parents\Requests\Request;

final class UpdateRoleRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'required|max:32|unique:roles,name,'.$this->name,
            'permissions' => 'array',
        ];
    }

    public function authorize(): bool
    {
        Sanctum::actingAs(request()->user(), [], 'web');
        return $this->check('update permissions');
    }
}
