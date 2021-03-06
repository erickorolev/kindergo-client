<?php

declare(strict_types=1);

namespace Domains\Users\Http\Requests\Admin;

use BenSampo\Enum\Rules\EnumValue;
use Domains\Users\Enums\AttendantGenderEnum;
use Illuminate\Validation\Rule;
use Parents\Requests\Request;

final class UserUpdateRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:255', 'string'],
            'email' => [
                'required',
                Rule::unique('users')->ignore($this->user, 'id'),
                'email',
            ],
            'firstname' => ['required', 'max:190', 'string'],
            'lastname' => ['required', 'max:190', 'string'],
            'middle_name' => ['nullable', 'max:190', 'string'],
            'phone' => ['required', 'max:20', 'phone:RU'],
            'attendant_gender' => ['required', new EnumValue(AttendantGenderEnum::class)],
            'otherphone' => ['nullable', 'max:20', 'phone:RU'],
            'imagename' => ['nullable', 'image'],
            'roles' => 'array',
        ];
    }

    public function authorize(): bool
    {
        return $this->check('update users');
    }
}
