<?php

declare(strict_types=1);

namespace Domains\Trips\DataTransferObjects;

use Domains\Attendants\Actions\GetClearAttendantIdAction;
use Domains\Children\Actions\GetChildrenIdsFromArrayAction;
use Domains\Timetables\Actions\GetClearTimetableIdAction;
use Domains\Trips\Enums\TripStatusEnum;
use Domains\Users\Actions\GetClearUserIdAction;
use Illuminate\Support\Collection;
use Parents\DataTransferObjects\ObjectData;
use Illuminate\Support\Carbon;
use Parents\Requests\Request;
use Parents\ValueObjects\CrmIdValueObject;
use Parents\ValueObjects\MoneyValueObject;
use Parents\ValueObjects\TimeValueObject;
use Parents\ValueObjects\UrlValueObject;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

final class TripData extends ObjectData
{
    public ?int $id;

    public string $name;

    public string $where_address;

    public Carbon $date;

    public TimeValueObject $time;

    public int $childrens;

    public TripStatusEnum $status;

    public ?int $attendant_id;

    public int $timetable_id;

    public int $scheduled_wait_where;

    public int $scheduled_wait_from;

    public MoneyValueObject $parking_cost;

    public ?int $user_id;

    public ?CrmIdValueObject $crmid;

    public CrmIdValueObject $assigned_user_id;

    public ?string $file;

    public UrlValueObject $external_file;

    public ?Media $avatar;

    public array $children = [];

    public Carbon $created_at;

    public Carbon $updated_at;

    public static function fromRequest(Request $request, string $prefix = ''): self
    {
        /** @var int $attendant_id */
        $attendant_id = GetClearAttendantIdAction::run($request->input($prefix . 'attendant_id'));
        /** @var int $timetable_id */
        $timetable_id = GetClearTimetableIdAction::run($request->input($prefix . 'timetable_id'));
        $user_id = GetClearUserIdAction::run($request->input($prefix . 'user_id'));
        $children = GetChildrenIdsFromArrayAction::run($request->input($prefix . 'children', []));
        return new self([
            'created_at' => now(),
            'updated_at' => now(),
            'name' => $request->input($prefix . 'name'),
            'where_address' => $request->input($prefix . 'where_address'),
            'date' => Carbon::createFromFormat('Y-m-d', $request->input($prefix . 'date')),
            'time' => TimeValueObject::fromNative($request->input($prefix . 'time')),
            'childrens' => (int) $request->input($prefix . 'childrens'),
            'status' => TripStatusEnum::fromValue($request->input($prefix . 'status')),
            'attendant_id' => $attendant_id,
            'timetable_id' => $timetable_id,
            'scheduled_wait_where' => (int) $request->input($prefix . 'scheduled_wait_where'),
            'scheduled_wait_from' => (int) $request->input($prefix . 'scheduled_wait_from'),
            'parking_cost' => MoneyValueObject::fromNative($request->input($prefix . 'parking_cost')),
            'user_id' => $user_id,
            'crmid' => CrmIdValueObject::fromNative($request->input($prefix . 'crmid')),
            'assigned_user_id' => CrmIdValueObject::fromNative(
                $request->input($prefix . 'assigned_user_id')
            ),
            'file' => $request->input($prefix . 'file'),
            'external_file' => UrlValueObject::fromNative($request->input($prefix . 'external_file')),
            'children' => $children->toArray()
        ]);
    }

    public static function fromConnector(Collection $data): self
    {
        /** @var int $attendant_id */
        $attendant_id = GetClearAttendantIdAction::run($data->get('cf_nrl_contacts59_id'));
        /** @var int $timetable_id */
        $timetable_id = GetClearTimetableIdAction::run($data->get('cf_nrl_timetable926_id'));
        $user_id = GetClearUserIdAction::run($data->get('trips_contact'));
        $children = GetChildrenIdsFromArrayAction::run($data->get('children', []));
        return new self([
            'created_at' => now(),
            'updated_at' => now(),
            'name' => $data->get('name'),
            'where_address' => $data->get('where_address'),
            'date' => Carbon::createFromFormat('Y-m-d', $data->get('date')),
            'time' => TimeValueObject::fromNative($data->get('time')),
            'childrens' => (int) $data->get('childrens'),
            'status' => TripStatusEnum::fromValue($data->get('status')),
            'attendant_id' => $attendant_id,
            'timetable_id' => $timetable_id,
            'scheduled_wait_where' => (int) $data->get('scheduled_wait_where'),
            'scheduled_wait_from' => (int) $data->get('scheduled_wait_from'),
            'parking_cost' => MoneyValueObject::fromNative($data->get('parking_cost')),
            'user_id' => $user_id,
            'crmid' => CrmIdValueObject::fromNative($data->get('id')),
            'assigned_user_id' => CrmIdValueObject::fromNative($data->get('assigned_user_id')),
            'children' => $children->toArray()
        ]);
    }
}
