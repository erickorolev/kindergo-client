<?php

declare(strict_types=1);

namespace Domains\Attendants\DataTransferObjects;

use Parents\DataTransferObjects\ObjectData;
use Illuminate\Support\Carbon;
use Parents\Enums\GenderEnum;
use Parents\Requests\Request;
use Parents\ValueObjects\CrmIdValueObject;
use Parents\ValueObjects\EmailValueObject;
use Parents\ValueObjects\PhoneNumberValueObject;
use Parents\ValueObjects\UrlValueObject;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

final class AttendantData extends ObjectData
{
    public ?int $id;

    public string $firstname;

    public string $lastname;

    public ?string $middle_name;

    public EmailValueObject $email;

    public string $resume;

    public string $car_model;

    public string $car_year;

    public GenderEnum $gender;

    public PhoneNumberValueObject $phone;

    public CrmIdValueObject $crmid;

    public ?string $file;

    public ?Media $avatar;

    public ?string $avatar_path;

    public UrlValueObject $external_file;

    public Carbon $created_at;

    public Carbon $updated_at;

    /**
     * @param  Request  $request
     * @param  string  $prefix
     * @return static
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     * @psalm-suppress PossiblyInvalidMethodCall
     */
    public static function fromRequest(Request $request, string $prefix = ''): self
    {
        return new self([
            'created_at' => now(),
            'updated_at' => now(),
            'file' => $request->input($prefix . 'file'),
            'external_file' => UrlValueObject::fromNative($request->input($prefix . 'external_file')),
            'crmid' => CrmIdValueObject::fromNative($request->input($prefix . 'crmid')),
            'avatar_path' => $request->file($prefix . 'imagename')?->path(),
            'firstname' => $request->input($prefix . 'firstname'),
            'lastname' => $request->input($prefix . 'lastname'),
            'middle_name' => $request->input($prefix . 'middle_name'),
            'phone' => PhoneNumberValueObject::fromNative($request->input($prefix . 'phone')),
            'gender' => GenderEnum::fromValue($request->input($prefix . 'gender')),
            'email' => EmailValueObject::fromNative($request->input($prefix . 'email')),
            'resume' => $request->input($prefix . 'resume'),
            'car_model' => $request->input($prefix . 'car_model'),
            'car_year' => $request->input($prefix . 'car_year')
        ]);
    }
}
