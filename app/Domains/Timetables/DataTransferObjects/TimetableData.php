<?php

declare(strict_types=1);

namespace Domains\Timetables\DataTransferObjects;

use Domains\Timetables\Enums\TimetableStatusEnum;
use Domains\Users\Actions\GetClearUserIdAction;
use Parents\DataTransferObjects\ObjectData;
use Illuminate\Support\Carbon;
use Parents\Requests\Request;
use Parents\ValueObjects\CrmIdValueObject;
use Parents\ValueObjects\TimeValueObject;

final class TimetableData extends ObjectData
{
    public ?int $id;

    public string $name;

    public string $where_address;

    public int $trips;

    public int $childrens;

    public string $childrens_age;

    public Carbon $date;

    public TimeValueObject $time;

    public int $duration;

    public float $distance;

    public int $scheduled_wait_from;

    public int $scheduled_wait_where;

    public ?TimetableStatusEnum $status;

    public bool $bill_paid;

    public string $description;

    public string $parking_info;

    public ?int $user_id;

    public ?CrmIdValueObject $crmid;

    public Carbon $created_at;

    public Carbon $updated_at;

    public static function fromRequest(Request $request): self
    {
        return new self([
            'created_at' => now(),
            'updated_at' => now(),
            'name' => $request->input('name'),
            'where_address' => $request->input('where_address'),
            'trips' => (int) $request->input('trips'),
            'childrens' => (int) $request->input('childrens'),
            'childrens_age' => $request->input('childrens_age'),
            'date' => Carbon::createFromFormat('Y-m-d', $request->input('date')),
            'time' => TimeValueObject::fromNative($request->input('time')),
            'duration' => (int) $request->input('duration'),
            'distance' => (float) $request->input('distance'),
            'scheduled_wait_from' => (int) $request->input('scheduled_wait_from'),
            'scheduled_wait_where' => (int) $request->input('scheduled_wait_where'),
            'status' => $request->input('status') ?
                TimetableStatusEnum::fromValue($request->input('status')) : null,
            'bill_paid' => $request->boolean('bill_paid'),
            'description' => $request->input('description'),
            'parking_info' => $request->input('parking_info'),
            'user_id' => GetClearUserIdAction::run($request->input('user_id')),
            'crmid' => CrmIdValueObject::fromNative($request->input('crmid'))
        ]);
    }
}
