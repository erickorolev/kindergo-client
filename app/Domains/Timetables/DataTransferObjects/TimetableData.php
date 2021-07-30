<?php

declare(strict_types=1);

namespace Domains\Timetables\DataTransferObjects;

use Domains\Children\Actions\GetChildrenIdsFromArrayAction;
use Domains\Timetables\Enums\TimetableStatusEnum;
use Domains\Users\Actions\GetClearUserIdAction;
use Illuminate\Support\Collection;
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

    public array $children = [];

    public Carbon $created_at;

    public Carbon $updated_at;

    public static function fromRequest(Request $request, string $prefix = ''): self
    {
        /** @var Collection $children */
        $children = GetChildrenIdsFromArrayAction::run($request->input($prefix . 'children', []));
        return new self([
            'created_at' => now(),
            'updated_at' => now(),
            'name' => $request->input($prefix . 'name'),
            'where_address' => $request->input($prefix . 'where_address'),
            'trips' => (int) $request->input($prefix . 'trips'),
            'childrens' => (int) $request->input($prefix . 'childrens'),
            'childrens_age' => $request->input($prefix . 'childrens_age'),
            'date' => Carbon::createFromFormat('Y-m-d', $request->input($prefix . 'date')),
            'time' => TimeValueObject::fromNative($request->input($prefix . 'time')),
            'duration' => (int) $request->input($prefix . 'duration'),
            'distance' => (float) $request->input($prefix . 'distance'),
            'scheduled_wait_from' => (int) $request->input($prefix . 'scheduled_wait_from'),
            'scheduled_wait_where' => (int) $request->input($prefix . 'scheduled_wait_where'),
            'status' => $request->input($prefix . 'status') ?
                TimetableStatusEnum::fromValue($request->input($prefix . 'status')) : null,
            'bill_paid' => $request->boolean($prefix . 'bill_paid'),
            'description' => $request->input($prefix . 'description'),
            'parking_info' => $request->input($prefix . 'parking_info'),
            'user_id' => GetClearUserIdAction::run($request->input($prefix . 'user_id')),
            'crmid' => CrmIdValueObject::fromNative($request->input($prefix . 'crmid')),
            'children' => $children->toArray()
        ]);
    }

    public static function fromConnector(Collection $data): self
    {
        /** @var Collection $children */
        $children = GetChildrenIdsFromArrayAction::run($data->get('children', []));
        return new self([
            'created_at' => now(),
            'updated_at' => now(),
            'name' => $data->get('name'),
            'where_address' => $data->get('where_address'),
            'trips' => (int) $data->get('trips'),
            'childrens' => (int) $data->get('childrens'),
            'childrens_age' => $data->get('childrens_age'),
            'date' => Carbon::createFromFormat('Y-m-d', $data->get('date')),
            'time' => TimeValueObject::fromNative($data->get('time')),
            'duration' => (int) $data->get('duration'),
            'distance' => (float) $data->get('distance'),
            'scheduled_wait_from' => (int) $data->get('scheduled_wait_from'),
            'scheduled_wait_where' => (int) $data->get('scheduled_wait_where'),
            'status' => $data->get('status') ?
                TimetableStatusEnum::fromValue($data->get('status')) : null,
            'bill_paid' => (bool) $data->get('bill_paid'),
            'description' => $data->get('description'),
            'parking_info' => $data->get('parking_info'),
            'user_id' => GetClearUserIdAction::run($data->get('user_id')),
            'crmid' => CrmIdValueObject::fromNative($data->get('id')),
            'children' => $children->toArray()
        ]);
    }
}
