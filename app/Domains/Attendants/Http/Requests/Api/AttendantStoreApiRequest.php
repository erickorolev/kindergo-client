<?php

declare(strict_types=1);

namespace Domains\Attendants\Http\Requests\Api;

use BenSampo\Enum\Rules\EnumValue;
use Parents\Enums\GenderEnum;
use Parents\Requests\Request;

final class AttendantStoreApiRequest extends Request
{
    public function rules(): array
    {
        $rules = [
            'data.attributes.firstname' => ['required', 'max:190', 'string'],
            'data.attributes.lastname' => ['required', 'max:190', 'string'],
            'data.attributes.middle_name' => ['nullable', 'max:190', 'string'],
            'data.attributes.phone' => ['required', 'max:20', 'phone:RU'],
            'data.attributes.resume' => ['nullable', 'string'],
            'data.attributes.car_model' => ['nullable', 'max:190', 'string'],
            'data.attributes.car_year' => ['nullable', 'max:50', 'string'],
            'data.attributes.email' => ['required', 'email'],
            'data.attributes.gender' => ['required', new EnumValue(GenderEnum::class)],
            'data.attributes.imagename' => ['nullable', 'image'],
            'data.attributes.crmid' => ['nullable', 'max:50'],
            'data.attributes.assigned_user_id' => ['nullable', 'max:50', 'min:3'],
            'data.attributes.external_file' => ['nullable', 'url'],
            'data.attributes.file' => ['nullable', 'max:100'],
        ];
        return $this->mergeWithDefaultRules($rules);
    }

    public function authorize(): bool
    {
        return $this->check('create attendants');
    }
}
