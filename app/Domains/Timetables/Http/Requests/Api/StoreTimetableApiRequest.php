<?php

declare(strict_types=1);

namespace Domains\Timetables\Http\Requests\Api;

use BenSampo\Enum\Rules\EnumValue;
use Domains\Timetables\Enums\TimetableStatusEnum;
use Parents\Requests\Request;

final class StoreTimetableApiRequest extends Request
{
    public function rules(): array
    {
        $rules = [
            'data.attributes.name' => ['required', 'max:190', 'string'],
            'data.attributes.where_address' => ['required', 'max:190', 'string'],
            'data.attributes.trips' => ['required', 'numeric'],
            'data.attributes.childrens' => ['required', 'numeric'],
            'data.attributes.childrens_age' => ['required', 'max:100', 'string'],
            'data.attributes.date' => ['nullable', 'date'],
            'data.attributes.time' => ['nullable', 'date_format:H:i:s'],
            'data.attributes.duration' => ['required', 'numeric'],
            'data.attributes.distance' => ['required', 'numeric'],
            'data.attributes.insurances' => ['required', 'numeric'],
            'data.attributes.scheduled_wait_from' => ['required', 'numeric'],
            'data.attributes.scheduled_wait_where' => ['required', 'numeric'],
            'data.attributes.status' => ['nullable', new EnumValue(TimetableStatusEnum::class)],
            'data.attributes.bill_paid' => ['required', 'boolean'],
            'data.attributes.description' => ['nullable', 'max:255', 'string'],
            'data.attributes.parking_info' => ['nullable', 'max:255', 'string'],
            'data.attributes.user_id' => ['nullable'],
            'data.attributes.crmid' => ['nullable', 'max:50'],
            'data.attributes.assigned_user_id' => ['nullable', 'max:50', 'min:3'],
        ];
        return $this->mergeWithDefaultRules($rules);
    }

    public function authorize(): bool
    {
        return $this->check('create timetables');
    }
}
