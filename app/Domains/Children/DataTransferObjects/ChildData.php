<?php

declare(strict_types=1);


namespace Domains\Children\DataTransferObjects;

use Parents\DataTransferObjects\ObjectData;
use Illuminate\Support\Carbon;
use Parents\Enums\GenderEnum;
use Parents\Requests\Request;
use Parents\ValueObjects\CrmIdValueObject;
use Parents\ValueObjects\PhoneNumberValueObject;
use Parents\ValueObjects\UrlValueObject;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

final class ChildData extends ObjectData
{
    public ?int $id;

    public string $firstname;

    public string $lastname;

    public ?string $middle_name;

    public Carbon $birthday;

    public GenderEnum $gender;

    public PhoneNumberValueObject $phone;

    public ?PhoneNumberValueObject $otherphone;

    public CrmIdValueObject $crmid;

    public ?string $file;

    public ?Media $avatar;

    public ?string $avatar_path;

    public UrlValueObject $external_file;

    public array $users;

    public Carbon $created_at;

    public Carbon $updated_at;

    public static function fromRequest(Request $request, string $prefix = ''): self
    {
        return new self([
            'created_at' => now(),
            'updated_at' => now(),
            'file' => $request->input($prefix . 'file'),
            'external_file' => UrlValueObject::fromNative($request->input($prefix . 'external_file')),
            'crmid' => CrmIdValueObject::fromNative($request->input($prefix . 'crmid')),
            'avatar_path' => $request->file($prefix . 'imagename')?->path(),
            'otherphone' => $request->input($prefix . 'otherphone') ?
                PhoneNumberValueObject::fromNative($request->input($prefix . 'otherphone')) : null,
            'firstname' => $request->input($prefix . 'firstname'),
            'lastname' => $request->input($prefix . 'lastname'),
            'middle_name' => $request->input($prefix . 'middle_name'),
            'phone' => PhoneNumberValueObject::fromNative($request->input($prefix . 'phone')),
            'birthday' => Carbon::createFromFormat('Y-m-d', $request->input($prefix . 'birthday')),
            'gender' => GenderEnum::fromValue($request->input($prefix . 'gender')),
            'users' => $request->input($prefix . 'users', [])
        ]);
    }
}
