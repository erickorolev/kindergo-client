<?php

declare(strict_types=1);


namespace Domains\Children\Transformers;

use Parents\Transformers\MediaTransformer;
use Parents\Transformers\Transformer;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

final class ChildTransformer extends Transformer
{
    protected $availableIncludes = [

    ];

    public function transform($model): array
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
            'phone' => $model->phone->toDisplayValue(),
            'gender' => $model->gender->toArray(),
            'otherphone' => $model->otherphone?->toDisplayValue(),
            'crmid' => $model->crmid?->toNative(),
            'birthday' => $model->birthday,
            'meta' => [
                'created_at' => $model->created_at,
                'updated_at' => $model->updated_at
            ],
            'media' => $medias,
        ];
    }
}
