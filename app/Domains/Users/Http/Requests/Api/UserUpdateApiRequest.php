<?php

declare(strict_types=1);

namespace Domains\Users\Http\Requests\Api;

use BenSampo\Enum\Rules\EnumValue;
use Domains\Users\Enums\AttendantGenderEnum;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Parents\Requests\Request;

final class UserUpdateApiRequest extends Request
{
    public function rules(): array
    {
        $rules = [
            'data.attributes.name' => ['nullable', 'max:255', 'string'],
            'data.attributes.email' => ['required',
                Rule::unique('users', 'email')->ignore($this->user, 'id'),
                'email',],
            'data.attributes.password' => ['nullable'],
            'data.attributes.firstname' => ['required', 'max:190', 'string'],
            'data.attributes.lastname' => ['required', 'max:190', 'string'],
            'data.attributes.middle_name' => ['nullable', 'max:190', 'string'],
            'data.attributes.phone' => ['required', 'phone:RU'],
            'data.attributes.attendant_gender' => ['required', new EnumValue(AttendantGenderEnum::class)],
            'data.attributes.otherphone' => ['nullable', 'phone:RU'],
            'data.attributes.file' => ['nullable', 'max:100'],
            'data.attributes.roles' => ['nullable', 'array'],
            'data.attributes.external_file' => ['nullable', 'url'],
            'data.attributes.crmid' => ['nullable', 'max:50']
        ];
        return $this->mergeWithDefaultRules($rules);
    }

    public function authorize(): bool
    {
        if (Auth::id() == $this->user) {
            return true;
        }
        return $this->check('update users');
    }
}
