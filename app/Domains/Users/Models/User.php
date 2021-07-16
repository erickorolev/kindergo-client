<?php

declare(strict_types=1);

namespace Domains\Users\Models;

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
use Spatie\Permission\Traits\HasRoles;
use Units\Filterings\Scopes\Searchable;

final class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use HasFactory;
    use Searchable;
    use SoftDeletes;
    use HasApiTokens;
    use HasProfilePhoto;
    use TwoFactorAuthenticatable;

    public const DOMAIN_NAME = 'Users';

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
        'email' => EmailValueObjectCast::class,
        'phone' => PhoneValueObjectCast::class,
        'otherphone' => PhoneValueObjectCast::class,
        'crmid' => CrmIdValueObjectCast::class
    ];

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

    /**
     * Create a new factory instance for the model.
     *
     * @return Factory
     */
    protected static function newFactory(): Factory
    {
        return UserFactory::new();
    }
}
