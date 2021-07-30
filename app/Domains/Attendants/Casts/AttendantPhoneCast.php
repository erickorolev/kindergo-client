<?php

declare(strict_types=1);

namespace Domains\Attendants\Casts;

use Domains\Attendants\Models\Attendant;
use Domains\Attendants\ValueObjects\AttendantPhoneNumber;
use Parents\Models\Model;
use Parents\ValueObjects\PhoneNumberValueObject;

final class AttendantPhoneCast extends \Parents\Casts\CastAbstract
{

    /**
     * @psalm-param ?string $value
     * @param Attendant $model
     * @inheritDoc
     * @psalm-suppress MoreSpecificImplementedParamType
     */
    public function get($model, string $key, $value, array $attributes): ?AttendantPhoneNumber
    {
        if (!$value) {
            return null;
        }

        return AttendantPhoneNumber::fromNative($value);
    }

    /**
     * @param Model $model
     * @param AttendantPhoneNumber|string|null $value
     * @psalm-suppress MoreSpecificImplementedParamType
     * @inheritDoc
     */
    public function set($model, string $key, $value, array $attributes): ?string
    {
        if (!$value) {
            return null;
        }
        if (is_string($value)) {
            return $value;
        }
        return $value->toNative();
    }
}
