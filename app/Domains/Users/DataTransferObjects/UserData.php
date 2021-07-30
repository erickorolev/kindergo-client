<?php

declare(strict_types=1);

namespace Domains\Users\DataTransferObjects;

use Domains\Users\Enums\AttendantGenderEnum;
use Domains\Users\ValueObjects\FullNameValueObject;
use Domains\Users\ValueObjects\PasswordValueObject;
use Illuminate\Support\Collection;
use Parents\DataTransferObjects\ObjectData;
use Illuminate\Support\Carbon;
use Parents\Requests\Request;
use Parents\ValueObjects\CrmIdValueObject;
use Parents\ValueObjects\EmailValueObject;
use Parents\ValueObjects\PhoneNumberValueObject;
use Parents\ValueObjects\UrlValueObject;
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

    public ?string $file;

    public UrlValueObject $external_file;

    public PhoneNumberValueObject $phone;

    public AttendantGenderEnum $attendant_gender;

    public ?PhoneNumberValueObject $otherphone;

    public CrmIdValueObject $crmid;

    public CrmIdValueObject $assigned_user_id;

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
            'name' => FullNameValueObject::fromNative(
                $request->input($prefix . 'firstname'),
                $request->input($prefix . 'lastname'),
                $request->input($prefix . 'middle_name')
            ),
            'email' => $request->input($prefix . 'email'),
            'password' => $request->input($prefix . 'password') ?
                PasswordValueObject::fromNative($request->input($prefix . 'password')) : null,
            'firstname' => $request->input($prefix . 'firstname'),
            'lastname' => $request->input($prefix . 'lastname'),
            'middle_name' => $request->input($prefix . 'middle_name'),
            'phone' => PhoneNumberValueObject::fromNative($request->input($prefix . 'phone')),
            'attendant_gender' => AttendantGenderEnum::fromValue($request->input($prefix . 'attendant_gender')),
            'otherphone' => $request->input($prefix . 'otherphone') ?
                PhoneNumberValueObject::fromNative($request->input($prefix . 'otherphone')) : null,
            'created_at' => now(),
            'updated_at' => now(),
            'crmid' => CrmIdValueObject::fromNative($request->input($prefix . 'crmid')),
            'assigned_user_id' => CrmIdValueObject::fromNative(
                $request->input($prefix . 'assigned_user_id')
            ),
            'avatar_path' => $request->file($prefix . 'imagename')?->path(),
            'roles' => $request->has($prefix . 'roles') ? $request->input($prefix . 'roles', []) : [],
            'file' => $request->input($prefix . 'file'),
            'external_file' => UrlValueObject::fromNative($request->input($prefix . 'external_file')),
        ]);
    }

    public static function fromConnector(Collection $data): self
    {
        return new self([
            'name' => FullNameValueObject::fromNative(
                $data->get('firstname'),
                $data->get('lastname'),
                $data->get('middle_name')
            ),
            'email' => $data->get('email'),
            'password' => PasswordValueObject::fromNative($data->get('password')),
            'firstname' => $data->get('firstname'),
            'lastname' => $data->get('lastname'),
            'middle_name' => $data->get('middle_name'),
            'phone' => PhoneNumberValueObject::fromNative($data->get('phone')),
            'attendant_gender' => AttendantGenderEnum::fromValue($data->get('attendant_gender')),
            'otherphone' => $data->get('otherphone') ?
                PhoneNumberValueObject::fromNative($data->get('otherphone')) : null,
            'created_at' => now(),
            'updated_at' => now(),
            'crmid' => CrmIdValueObject::fromNative($data->get('id')),
            'assigned_user_id' => CrmIdValueObject::fromNative($data->get('assigned_user_id')),
            'roles' => [],
            'external_file' => UrlValueObject::fromNative($data->get('external_file')),
        ]);
    }
}
