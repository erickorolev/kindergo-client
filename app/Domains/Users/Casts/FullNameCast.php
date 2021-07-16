<?php

declare(strict_types=1);


namespace Domains\Users\Casts;

use Domains\Users\Models\User;
use Domains\Users\ValueObjects\FullNameValueObject;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class FullNameCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  User  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function get($model, $key, $value, $attributes): FullNameValueObject
    {
        return FullNameValueObject::fromNative($model->firstname, $model->lastname, $model->middle_name);
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  ?FullNameValueObject|string  $value
     * @param  array  $attributes
     * @return string
     */
    public function set($model, $key, $value, $attributes): string
    {
        /*
         * We'll need this to handle nullable columns
         */
        if (is_null($value)) {
            return '';
        }
        if (! $value instanceof FullNameValueObject) {
            throw new \InvalidArgumentException('Value must be of type FullName or null');
        }
        return $value->toNative();
    }
}
