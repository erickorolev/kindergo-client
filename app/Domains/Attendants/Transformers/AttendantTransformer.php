<?php

declare(strict_types=1);

namespace Domains\Attendants\Transformers;

use Domains\Attendants\Models\Attendant;
use Domains\Trips\Models\Trip;
use Domains\Trips\Transformers\TripTransformer;
use Parents\Transformers\MediaTransformer;
use Parents\Transformers\Transformer;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

final class AttendantTransformer extends Transformer
{
    protected $availableIncludes = [
        'trips'
    ];

    public function transform(Attendant $model): array
    {
        $medias = $model->getMedia('avatar');
        $transformer = new MediaTransformer();
        $medias = $medias->map(function (Media $media) use ($transformer) {
            return $transformer->transform($media);
        });
        return [
            'id' => $model->id,
            'firstname' => $model->firstname,
            'lastname' => $model->lastname,
            'middle_name' => $model->middle_name,
            'phone' => $model->phone?->toDisplayValue(),
            'resume' => $model->resume,
            'car_model' => $model->car_model,
            'car_year' => $model->car_year,
            'gender' => $model->gender->toArray(),
            'crmid' => $model->crmid?->toNative(),
            'media' => $medias,
            'meta' => [
                'created_at' => $model->created_at,
                'updated_at' => $model->updated_at,
            ]
        ];
    }

    public function includeTrips(Attendant $model): \League\Fractal\Resource\Collection
    {
        return $this->collection($model->trips, new TripTransformer(), Trip::RESOURCE_NAME);
    }
}
