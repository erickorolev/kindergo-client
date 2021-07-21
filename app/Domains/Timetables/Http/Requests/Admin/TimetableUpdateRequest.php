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
            'date' => ['required', 'date'],
            'time' => ['required', 'date_format:H:i:s'],
            'duration' => ['required', 'numeric'],
            'distance' => ['required', 'numeric'],
            'scheduled_wait_from' => ['required', 'numeric'],
            'scheduled_wait_where' => ['required', 'numeric'],
            'status' => ['required', new EnumValue(TimetableStatusEnum::class)],
            'bill_paid' => ['required', 'boolean'],
            'description' => ['required', 'max:255', 'string'],
            'parking_info' => ['required', 'max:255', 'string'],
            'user_id' => ['nullable'],
            'crmid' => ['nullable', 'max:50'],
        ];
    }

    public function authorize(): bool
    {
        return $this->check('update timetables');
    }
}
