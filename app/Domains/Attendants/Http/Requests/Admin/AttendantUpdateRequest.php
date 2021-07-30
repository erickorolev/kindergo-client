<?php

declare(strict_types=1);

namespace Domains\Attendants\Http\Requests\Admin;

use BenSampo\Enum\Rules\EnumValue;
use Parents\Enums\GenderEnum;
use Parents\Requests\Request;

final class AttendantUpdateRequest extends Request
{
    public function rules(): array
    {
        return [
            'firstname' => ['required', 'max:190', 'string'],
            'lastname' => ['required', 'max:190', 'string'],
            'middle_name' => ['nullable', 'max:190', 'string'],
            'phone' => ['required', 'max:20', 'phone:RU'],
            'resume' => ['required', 'string'],
            'car_model' => ['required', 'max:190', 'string'],
            'car_year' => ['required', 'max:50', 'string'],
            'email' => ['required', 'email'],
            'gender' => ['required', new EnumValue(GenderEnum::class)],
            'imagename' => ['nullable', 'image'],
            'crmid' => ['nullable', 'max:50'],
            'assigned_user_id' => ['nullable', 'max:50', 'min:3'],
        ];
    }

    public function authorize(): bool
    {
        return $this->check('update attendants');
    }
}
