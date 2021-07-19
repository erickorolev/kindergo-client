<?php

declare(strict_types=1);

namespace Domains\Children\Models;

use Domains\Users\Casts\PhoneValueObjectCast;
use Domains\Users\Models\User;
use Parents\Casts\CrmIdValueObjectCast;
use Parents\Enums\GenderEnum;
use Parents\Models\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Units\Filterings\Scopes\Searchable;

final class Child extends Model implements HasMedia
{
    use Searchable;
    use InteractsWithMedia;

    public const RESOURCE_NAME = 'children';

    public const DOMAIN_NAME = 'Children';

    protected $fillable = [
        'firstname',
        'lastname',
        'middle_name',
        'birthday',
        'gender',
        'phone',
        'imagename',
        'otherphone',
        'crmid'
    ];

    protected array $searchableFields = ['*'];

    protected $casts = [
        'birthday' => 'date',
        'gender' => GenderEnum::class,
        'crmid' => CrmIdValueObjectCast::class,
        'phone' => PhoneValueObjectCast::class,
        'otherphone' => PhoneValueObjectCast::class,
    ];

    public function users(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function timetables()
    {
        return $this->belongsToMany(Timetable::class);
    }

    public function trips()
    {
        return $this->belongsToMany(Trip::class);
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
        $data['otherphone'] = $this->otherphone?->toNative();
        $data['gender'] = $this->gender->value;
        $data['crmid'] = $this->crmid?->toNative();
        return $data;
    }

    public function toFullArray(): array
    {
        $data = parent::toArray();
        $data['phone'] = $this->phone;
        $data['otherphone'] = $this->otherphone;
        $data['gender'] = $this->gender;
        $data['crmid'] = $this->crmid;
        $data['created_at'] = $this->created_at ?? now();
        $data['updated_at'] = $this->updated_at ?? now();
        return $data;
    }
}
