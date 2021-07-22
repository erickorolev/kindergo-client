<?php

declare(strict_types=1);

namespace Domains\Attendants\Models;

use Domains\Attendants\Factories\AttendantFactory;
use Domains\Trips\Models\Trip;
use Domains\Users\Casts\EmailValueObjectCast;
use Domains\Users\Casts\PhoneValueObjectCast;
use Parents\Casts\CrmIdValueObjectCast;
use Parents\Enums\GenderEnum;
use Parents\Models\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Units\Filterings\Scopes\Searchable;

final class Attendant extends Model implements HasMedia
{
    use Searchable;
    use InteractsWithMedia;

    public const RESOURCE_NAME = 'attendants';

    public const DOMAIN_NAME = 'Attendants';

    protected $fillable = [
        'firstname',
        'lastname',
        'middle_name',
        'phone',
        'resume',
        'car_model',
        'car_year',
        'imagename',
        'email',
        'gender',
        'crmid'
    ];

    protected $casts = [
        'phone' => PhoneValueObjectCast::class,
        'email' => EmailValueObjectCast::class,
        'gender' => GenderEnum::class,
        'crmid' => CrmIdValueObjectCast::class
    ];

    protected array $searchableFields = ['*'];

    public function trips(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Trip::class);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function getAvatarAttribute(): ?Media
    {
        /** @var ?Media $file */
        $file = $this->getMedia('avatar')->last();

        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function toArray(): array
    {
        $data = parent::toArray();
        $data['phone'] = $this->phone->toNative();
        $data['gender'] = $this->gender->value;
        $data['crmid'] = $this->crmid?->toNative();
        $data['email'] = $this->email->toNative();
        return $data;
    }

    public function toFullArray(): array
    {
        $data = parent::toArray();
        $data['phone'] = $this->phone;
        $data['gender'] = $this->gender;
        $data['crmid'] = $this->crmid;
        $data['email'] = $this->email;
        $data['created_at'] = $this->created_at ?? now();
        $data['updated_at'] = $this->updated_at ?? now();
        return $data;
    }

    protected static function newFactory(): AttendantFactory
    {
        return AttendantFactory::new();
    }
}
