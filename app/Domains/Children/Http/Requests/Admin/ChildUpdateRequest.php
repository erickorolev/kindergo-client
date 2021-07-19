<?php

declare(strict_types=1);


namespace Domains\Children\Http\Requests\Admin;

use BenSampo\Enum\Rules\EnumValue;
use Parents\Enums\GenderEnum;
use Parents\Requests\Request;

final class ChildUpdateRequest extends Request
{
    public function rules(): array
    {
        return [
            'firstname' => ['required', 'max:190', 'string'],
            'lastname' => ['required', 'max:190', 'string'],
            'middle_name' => ['nullable', 'max:190', 'string'],
            'birthday' => ['required', 'date'],
            'gender' => ['required', new EnumValue(GenderEnum::class)],
            'phone' => ['required', 'max:20', 'phone:RU'],
            'otherphone' => ['nullable', 'max:20', 'phone:RU'],
            'imagename' => ['nullable', 'image'],
        ];
    }

    public function authorize(): bool
    {
        return $this->check('update children');
    }
}
