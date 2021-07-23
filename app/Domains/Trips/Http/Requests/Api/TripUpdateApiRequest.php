<?php

declare(strict_types=1);

namespace Domains\Trips\Http\Requests\Api;

use BenSampo\Enum\Rules\EnumValue;
use Domains\Trips\Enums\TripStatusEnum;
use Parents\Requests\Request;

final class TripUpdateApiRequest extends Request
{
    public function rules(): array
    {
        $rules = [
            'data.attributes.name' => ['required', 'max:190', 'string'],
            'data.attributes.where_address' => ['required', 'max:190', 'string'],
            'data.attributes.date' => ['required', 'date'],
            'data.attributes.time' => ['required', 'date_format:H:i:s'],
            'data.attributes.childrens' => ['required', 'numeric'],
            'data.attributes.status' => [
                'required',
                new EnumValue(TripStatusEnum::class),
            ],
            'data.attributes.attendant_id' => ['nullable'],
            'data.attributes.timetable_id' => ['required'],
            'data.attributes.scheduled_wait_where' => ['required', 'numeric'],
            'data.attributes.scheduled_wait_from' => ['required', 'numeric'],
            'data.attributes.parking_cost' => ['required', 'numeric'],
        ];
        return $this->mergeWithDefaultRules($rules);
    }

    public function authorize(): bool
    {
        return $this->check('update trips');
    }
}
