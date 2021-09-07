<?php

declare(strict_types=1);

namespace Domains\Trips\Transformers;

use Domains\Attendants\Models\Attendant;
use Domains\Attendants\Transformers\AttendantTransformer;
use Domains\Children\Models\Child;
use Domains\Children\Transformers\ChildTransformer;
use Domains\Timetables\Models\Timetable;
use Domains\Timetables\Transformers\TimetableTransformer;
use Domains\Trips\Models\Trip;
use Domains\Users\Models\User;
use Domains\Users\Transformers\UserTransformer;
use Parents\Transformers\Transformer;

final class TripTransformer extends Transformer
{
    protected $availableIncludes = [
        'timetable', 'children', 'user', 'attendant'
    ];

    public function transform(Trip $model): array
    {
        return [
            'id' => $model->id,
            'name' => $model->name,
            'where_address' => $model->where_address,
            'date' => $model->date,
            'time' => $model->time?->toNative(),
            'childrens' => $model->childrens,
            'status' => $model->status->toArray(),
            'attendant_id' => $model->attendant_id,
            'timetable_id' => $model->timetable_id,
            'scheduled_wait_where' => $model->scheduled_wait_where,
            'scheduled_wait_from' => $model->scheduled_wait_from,
            'parking_cost' => $model->parking_cost?->toNative(),
            'meta' => [
                'created_at' => $model->created_at,
                'updated_at' => $model->updated_at
            ]
        ];
    }

    public function includeTimetable(Trip $model): \League\Fractal\Resource\Item
    {
        return $this->item($model->timetable, new TimetableTransformer(), Timetable::RESOURCE_NAME);
    }

    public function includeUser(Trip $model): \League\Fractal\Resource\Item
    {
        return $this->item($model->user, new UserTransformer(), User::RESOURCE_NAME);
    }

    public function includeChildren(Trip $model): \League\Fractal\Resource\Collection
    {
        return $this->collection($model->children, new ChildTransformer(), Child::RESOURCE_NAME);
    }

    public function includeAttendant(Trip $model): ?\League\Fractal\Resource\Item
    {
        if (!$model->attendant) {
            return null;
        }
        return $this->item($model->attendant, new AttendantTransformer(), Attendant::RESOURCE_NAME);
    }
}
