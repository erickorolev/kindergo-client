<?php

declare(strict_types=1);

namespace Domains\Trips\Http\Requests\Admin;

use BenSampo\Enum\Rules\EnumValue;
use Domains\Trips\Enums\TripStatusEnum;
use Parents\Requests\Request;

final class TripStoreRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:190', 'string'],
            'where_address' => ['required', 'max:190', 'string'],
            'date' => ['required', 'date'],
            'time' => ['required', 'date_format:H:i:s'],
            'childrens' => ['required', 'numeric'],
            'status' => [
                'required',
                new EnumValue(TripStatusEnum::class),
            ],
            'attendant_id' => ['nullable'],
            'timetable_id' => ['required'],
            'scheduled_wait_where' => ['required', 'numeric'],
            'scheduled_wait_from' => ['required', 'numeric'],
            'parking_cost' => ['required', 'numeric'],
            'crmid' => ['nullable', 'max:50'],
            'assigned_user_id' => ['nullable', 'max:50', 'min:3'],
        ];
    }

    public function authorize(): bool
    {
        return $this->check('create trips');
    }
}
