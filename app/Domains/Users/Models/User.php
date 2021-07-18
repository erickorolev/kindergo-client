<?php

declare(strict_types=1);

namespace Domains\Users\Models;

use Domains\Authorization\Models\Role;
use Domains\Users\Casts\EmailValueObjectCast;
use Domains\Users\Casts\FullNameCast;
use Domains\Users\Casts\PhoneValueObjectCast;
use Domains\Users\Enums\AttendantGenderEnum;
use Domains\Users\Factories\UserFactory;
use Domains\Users\ValueObjects\FullNameValueObject;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Parents\Casts\CrmIdValueObjectCast;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Permission\Traits\HasRoles;
use Units\Filterings\Scopes\Searchable;

final class User extends Authenticatable implements HasMedia
{
    use Notifiable;
    use HasRoles;
    use HasFactory;
    use Searchable;
    use SoftDeletes;
    use HasApiTokens;
    use HasProfilePhoto;
    use TwoFactorAuthenticatable;
    use InteractsWithMedia;

    public const DOMAIN_NAME = 'Users';

    public const RESOURCE_NAME = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'firstname',
        'lastname',
        'middle_name',
        'phone',
        'attendant_gender',
        'otherphone',
        'crmid'
    ];

    protected array $searchableFields = ['*'];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_secret',
        'two_factor_recovery_codes',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'attendant_gender' => AttendantGenderEnum::class,
        'name' => FullNameCast::class,
        'phone' => PhoneValueObjectCast::class,
        'otherphone' => PhoneValueObjectCast::class,
        'crmid' => CrmIdValueObjectCast::class
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        self::created(function (User $user) {
            /** @var string $registrationRole */
            $registrationRole = config('panel.registration_default_role', 'client');
            /** @var Role $role */
            $role = Role::whereName($registrationRole)->first();
            if (!$role) {
                return;
            }
            /** @var string $roleName */
            $roleName = $role->name;
            if (!$user->hasRole($roleName)) {
                $user->assignRole($role);
            }
        });
    }

    public function timetables()
    {
        return $this->hasMany(Timetable::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function children()
    {
        return $this->belongsToMany(Child::class);
    }

    public function isSuperAdmin(): bool
    {
        return $this->hasRole('super-admin');
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

    /**
     * Create a new factory instance for the model.
     *
     * @return Factory
     */
    protected static function newFactory(): Factory
    {
        return UserFactory::new();
    }

    public function toArray(): array
    {
        $data = parent::toArray();
        $data['phone'] = $this->phone->toNative();
        $data['otherphone'] = $this->otherphone?->toNative();
        $data['name'] = $this->name->toNative();
        $data['attendant_gender'] = $this->attendant_gender->value;
        $data['crmid'] = $this->crmid?->toNative();
        return $data;
    }

    public function toFullArray(): array
    {
        $data = parent::toArray();
        $data['phone'] = $this->phone;
        $data['otherphone'] = $this->otherphone;
        $data['name'] = $this->name;
        $data['attendant_gender'] = $this->attendant_gender;
        $data['email_verified_at'] = $this->email_verified_at;
        $data['crmid'] = $this->crmid;
        $data['created_at'] = $this->created_at ?? now();
        $data['updated_at'] = $this->updated_at ?? now();
        return $data;
    }
}
