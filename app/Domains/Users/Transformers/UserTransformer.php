<?php

declare(strict_types=1);

namespace Domains\Users\Transformers;

use Domains\Children\Models\Child;
use Domains\Children\Transformers\ChildTransformer;
use Domains\Payments\Models\Payment;
use Domains\Payments\Transformers\PaymentTransformer;
use Domains\Timetables\Models\Timetable;
use Domains\Timetables\Transformers\TimetableTransformer;
use Domains\Users\Models\User;
use Parents\Transformers\MediaTransformer;
use Parents\Transformers\Transformer;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

final class UserTransformer extends Transformer
{
    protected $availableIncludes = [
        'children', 'timetables', 'payments'
    ];

    public function transform(User $model): array
    {
        $medias = $model->getMedia('avatar');
        $transformer = new MediaTransformer();
        $medias = $medias->map(function (Media $media) use ($transformer) {
            return $transformer->transform($media);
        });
        return [
            'id' => $model->id,
            'name' => $model->name->toNative(),
            'email' => $model->email,
            'firstname' => $model->firstname,
            'lastname' => $model->lastname,
            'middle_name' => $model->middle_name,
            'phone' => $model->phone?->toDisplayValue(),
            'attendant_gender' => $model->attendant_gender->toArray(),
            'otherphone' => $model->otherphone?->toDisplayValue(),
            'crmid' => $model->crmid?->toNative(),
            'meta' => [
                'created_at' => $model->created_at,
                'updated_at' => $model->updated_at
            ],
            'media' => $medias,
        ];
    }

    public function includeChildren(User $model): \League\Fractal\Resource\Collection
    {
        return $this->collection($model->children, new ChildTransformer(), Child::RESOURCE_NAME);
    }

    public function includeTimetables(User $model): \League\Fractal\Resource\Collection
    {
        return $this->collection($model->timetables, new TimetableTransformer(), Timetable::RESOURCE_NAME);
    }

    public function includePayments(User $model): \League\Fractal\Resource\Collection
    {
        return $this->collection($model->payments, new PaymentTransformer(), Payment::RESOURCE_NAME);
    }
}
