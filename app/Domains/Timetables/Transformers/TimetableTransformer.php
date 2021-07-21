<?php

declare(strict_types=1);

namespace Domains\Timetables\Transformers;

use Domains\Children\Models\Child;
use Domains\Children\Transformers\ChildTransformer;
use Domains\Timetables\Models\Timetable;
use Domains\Users\Models\User;
use Domains\Users\Transformers\UserTransformer;
use Parents\Transformers\Transformer;

final class TimetableTransformer extends Transformer
{
    protected $availableIncludes = [
        'user', 'children'
    ];

    public function transform(Timetable $model): array
    {
        return [
            'id' => $model->id,
            'name' => $model->name,
            'where_address' => $model->where_address,
            'trips' => $model->trips,
            'childrens' => $model->childrens,
            'childrens_age' => $model->childrens_age,
            'date' => $model->date,
            'time' => $model->time->toNative(),
            'duration' => $model->duration,
            'distance' => $model->distance,
            'scheduled_wait_from' => $model->scheduled_wait_from,
            'scheduled_wait_where' => $model->scheduled_wait_where,
            'status' => $model->status,
            'bill_paid' => $model->bill_paid,
            'description' => $model->description,
            'parking_info' => $model->parking_info,
            'user_id' => $model->user_id,
            'crmid' => $model->crmid?->toNative()
        ];
    }

    public function includeUser(Timetable $timetable): \League\Fractal\Resource\Item
    {
        return $this->item($timetable->user, new UserTransformer(), User::RESOURCE_NAME);
    }

    public function includeChildren(Timetable $timetable): \League\Fractal\Resource\Collection
    {
        return $this->collection($timetable->children, new ChildTransformer(), Child::RESOURCE_NAME);
    }
}
