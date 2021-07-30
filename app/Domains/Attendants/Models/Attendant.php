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

/**
 * Class Attendant
 * @package Domains\Attendants\Models
 * @property int $id
 * @property string $firstname Имя
 * @property string $lastname Фамилия
 * @property string|null $middle_name Отчество
 * @property \Parents\ValueObjects\PhoneNumberValueObject|null $phone Телефон
 * @property string $resume Анкета
 * @property string $car_model Марка автомобиля
 * @property string $car_year Год автомобиля
 * @property string|null $imagename Фотография
 * @property \Parents\ValueObjects\EmailValueObject|null|null $email Адрес электронной почты
 * @property \Parents\Enums\GenderEnum $gender Пол
 * @property \Parents\ValueObjects\CrmIdValueObject|null|null $crmid ID in Vtiger
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Media|null $avatar
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Domains\Trips\Models\Trip[] $trips
 * @property-read int|null $trips_count
 * @method static \Illuminate\Database\Eloquent\Builder|Attendant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Attendant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Attendant query()
 * @method static \Illuminate\Database\Eloquent\Builder|Attendant search($search)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendant searchLatestPaginated(string $search, string $paginationQuantity = 10)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendant whereCarModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendant whereCarYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendant whereCrmid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendant whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendant whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendant whereFirstname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendant whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendant whereImagename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendant whereLastname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendant whereMiddleName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendant wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendant whereResume($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendant whereUpdatedAt($value)
 */
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
        $data['phone'] = $this->phone?->toNative();
        $data['gender'] = $this->gender->value;
        $data['crmid'] = $this->crmid?->toNative();
        $data['email'] = $this->email?->toNative();
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

    public function toCrmArray(): array
    {
        $data = $this->toArray();
        $data['type'] = 'Attendant';
        unset(
            $data['crmid'],
            $data['id'],
            $data['created_at'],
            $data['updated_at'],
            $data['imagename'],
        );
        return $data;
    }

    protected static function newFactory(): AttendantFactory
    {
        return AttendantFactory::new();
    }
}
