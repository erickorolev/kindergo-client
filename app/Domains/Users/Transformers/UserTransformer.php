<?php

declare(strict_types=1);


namespace Domains\Users\Transformers;

use Domains\Users\Models\User;
use Parents\Transformers\Transformer;

final class UserTransformer extends Transformer
{
    public function transform(User $model): array
    {
        return [
            'id' => $model->id,
            'name' => $model->name->toNative(),
            'email' => $model->email->toNative(),
            'firstname' => $model->firstname,
            'lastname' => $model->lastname,
            'middle_name' => $model->middle_name,
            'phone' => $model->phone->toDisplayValue(),
            'attendant_gender' => $model->attendant_gender->toArray(),
            'otherphone' => $model->otherphone?->toDisplayValue(),
            'meta' => [
                'created_at' => $model->created_at,
                'updated_at' => $model->updated_at
            ]
        ];
    }
}
