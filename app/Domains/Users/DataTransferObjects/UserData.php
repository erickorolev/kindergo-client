<?php

declare(strict_types=1);

namespace Domains\Users\DataTransferObjects;

use Domains\Users\Enums\AttendantGenderEnum;
use Domains\Users\ValueObjects\FullNameValueObject;
use Domains\Users\ValueObjects\PasswordValueObject;
use Parents\DataTransferObjects\ObjectData;
use Illuminate\Support\Carbon;
use Parents\Requests\Request;
use Parents\ValueObjects\CrmIdValueObject;
use Parents\ValueObjects\EmailValueObject;
use Parents\ValueObjects\PhoneNumberValueObject;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

final class UserData extends ObjectData
{
    public ?int $id;

    public FullNameValueObject $name;

    public string $email;

    public ?Carbon $email_verified_at;

    public ?PasswordValueObject $password;

    public ?Media $avatar;

    public ?string $avatar_path;

    public string $firstname;

    public array $roles = [];

    public string $lastname;

    public ?string $middle_name;

    public PhoneNumberValueObject $phone;

    public AttendantGenderEnum $attendant_gender;

    public ?PhoneNumberValueObject $otherphone;

    public CrmIdValueObject $crmid;

    public Carbon $created_at;

    public Carbon $updated_at;

    public static function fromRequest(Request $request, string $prefix = ''): self
    {
        return new self([
            'name' => FullNameValueObject::fromNative(
                $request->input($prefix . 'firstname'),
                $request->input($prefix . 'lastname'),
                $request->input($prefix . 'middle_name')
            ),
            'email' => $request->input($prefix . 'email'),
            'password' => $request->input($prefix . 'password') ?
                PasswordValueObject::fromNative($request->input($prefix . 'password')) : null,
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'middle_name' => $request->input('middle_name'),
            'phone' => PhoneNumberValueObject::fromNative($request->input($prefix . 'phone')),
            'attendant_gender' => AttendantGenderEnum::fromValue($request->input($prefix . 'attendant_gender')),
            'otherphone' => $request->input($prefix . 'otherphone') ?
                PhoneNumberValueObject::fromNative($request->input($prefix . 'otherphone')) : null,
            'created_at' => now(),
            'updated_at' => now(),
            'crmid' => CrmIdValueObject::fromNative($request->input($prefix . 'crmid')),
            'avatar_path' => $request->file('imagename')?->path(),
            'roles' => $request->has('roles') ? $request->input($prefix . 'roles', []) : []
        ]);
    }
}
