<?php

declare(strict_types=1);


namespace Domains\Users\Http\Requests\Admin;

use BenSampo\Enum\Rules\EnumValue;
use Domains\Users\Enums\AttendantGenderEnum;
use Parents\Requests\Request;

final class UserStoreRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => ['nullable', 'max:255', 'string'],
            'email' => ['required', 'unique:users', 'email'],
            'password' => ['required'],
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
        return $this->check('create users');
    }
}
