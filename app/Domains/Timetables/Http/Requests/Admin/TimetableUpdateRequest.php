<?php

declare(strict_types=1);

namespace Domains\Timetables\Http\Requests\Admin;

use BenSampo\Enum\Rules\EnumValue;
use Domains\Timetables\Enums\TimetableStatusEnum;
use Parents\Requests\Request;

final class TimetableUpdateRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:190', 'string'],
            'where_address' => ['required', 'max:190', 'string'],
            'trips' => ['required', 'numeric'],
            'childrens' => ['required', 'numeric'],
            'childrens_age' => ['required', 'max:100', 'string'],
            'date' => ['nullable', 'string'],
            'time' => ['nullable', 'date_format:H:i:s'],
            'insurances' => ['required', 'numeric'],
            'duration' => ['required', 'numeric'],
            'distance' => ['required', 'numeric'],
            'scheduled_wait_from' => ['required', 'numeric'],
            'scheduled_wait_where' => ['required', 'numeric'],
            'status' => ['required', new EnumValue(TimetableStatusEnum::class)],
            'bill_paid' => ['required', 'boolean'],
            'description' => ['nullable', 'max:255', 'string'],
            'parking_info' => ['nullable', 'max:255', 'string'],
            'user_id' => ['nullable'],
            'crmid' => ['nullable', 'max:50'],
            'assigned_user_id' => ['nullable', 'max:50', 'min:3'],
        ];
    }

    public function authorize(): bool
    {
        return $this->check('update timetables');
    }
}
