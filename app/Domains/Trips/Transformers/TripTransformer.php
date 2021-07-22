<?php

declare(strict_types=1);

namespace Domains\Trips\Transformers;

use Domains\Children\Models\Child;
use Domains\Children\Transformers\ChildTransformer;
use Domains\Timetables\Models\Timetable;
use Domains\Timetables\Transformers\TimetableTransformer;
use Domains\Trips\Models\Trip;
use Parents\Transformers\Transformer;

final class TripTransformer extends Transformer
{
    protected $availableIncludes = [
        'timetable', 'children'
    ];

    public function transform(Trip $model): array
    {
        return [
            'id' => $model->id,
            'name' => $model->name,
            'date' => $model->date,
            'time' => $model->time->toNative(),
            'childrens' => $model->childrens,
            'status' => $model->status->toArray(),
            'attendant_id' => $model->attendant_id,
            'timetable_id' => $model->timetable_id,
            'scheduled_wait_where' => $model->scheduled_wait_where,
            'scheduled_wait_from' => $model->scheduled_wait_from,
            'parking_cost' => $model->parking_cost->toNative(),
            'meta' => [
                'created_at' => $model->created_at,
                'updated_at' => $model->updated_at
            ]
        ];
    }

    public function includeTimetables(Trip $model): \League\Fractal\Resource\Collection
    {
        return $this->collection($model->timetable, new TimetableTransformer(), Timetable::RESOURCE_NAME);
    }

    public function includeChildren(Trip $model): \League\Fractal\Resource\Collection
    {
        return $this->collection($model->childrens, new ChildTransformer(), Child::RESOURCE_NAME);
    }
}
