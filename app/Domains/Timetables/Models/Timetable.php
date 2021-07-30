<?php

declare(strict_types=1);

namespace Domains\Timetables\Models;

use Domains\Children\Models\Child;
use Domains\Timetables\Enums\TimetableStatusEnum;
use Domains\Timetables\Factories\TimetableFactory;
use Domains\Trips\Models\Trip;
use Domains\Users\Factories\UserFactory;
use Domains\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Parents\Casts\CrmIdValueObjectCast;
use Parents\Casts\TimeValueObjectCast;
use Parents\Models\Model;
use Parents\Scopes\UserScope;
use Units\Filterings\Scopes\Searchable;

/**
 * Class Timetable
 * @package Domains\Timetables\Models
 * @property int $id
 * @property string $name Откуда
 * @property string $where_address Куда
 * @property \Illuminate\Database\Eloquent\Collection|\Domains\Trips\Models\Trip[] $trips Количество поездок
 * @property int $childrens Количество детей
 * @property string $childrens_age Возраст детей
 * @property \Illuminate\Support\Carbon $date Дата отправления
 * @property \Parents\ValueObjects\TimeValueObject|null $time Время отправления
 * @property int $duration Длительность маршрута в минутах
 * @property float $distance Дистанция маршрута в км
 * @property int $scheduled_wait_from Запланированное ожидание в точке Откуда в минутах
 * @property int $scheduled_wait_where Запланированное ожидание в точке Куда в минутах
 * @property \Domains\Timetables\Enums\TimetableStatusEnum $status Статус
 * @property bool $bill_paid Оплачен ли счёт
 * @property string $description Описание
 * @property string $parking_info Информация о парковке
 * @property int|null $user_id Контакт
 * @property \Parents\ValueObjects\CrmIdValueObject|null|null $crmid ID in Vtiger
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Domains\Children\Models\Child[] $children
 * @property-read int|null $children_count
 * @property-read int|null $trips_count
 * @property-read \Domains\Users\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable query()
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable search($search)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable searchLatestPaginated(string $search, string $paginationQuantity = 10)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereBillPaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereChildrens($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereChildrensAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereCrmid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereDistance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereParkingInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereScheduledWaitFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereScheduledWaitWhere($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereTrips($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereWhereAddress($value)
 */
final class Timetable extends Model
{
    use Searchable;

    public const RESOURCE_NAME = 'timetables';

    public const DOMAIN_NAME = 'Timetable';

    protected $fillable = [
        'name',
        'where_address',
        'trips',
        'childrens',
        'childrens_age',
        'date',
        'time',
        'duration',
        'distance',
        'scheduled_wait_from',
        'scheduled_wait_where',
        'status',
        'bill_paid',
        'description',
        'parking_info',
        'user_id',
        'crmid'
    ];

    protected array $searchableFields = ['*'];

    protected $casts = [
        'date' => 'date',
        'bill_paid' => 'boolean',
        'crmid' => CrmIdValueObjectCast::class,
        'status' => TimetableStatusEnum::class,
        'trips' => 'integer',
        'childrens' => 'integer',
        'duration' => 'integer',
        'distance' => 'float',
        'scheduled_wait_from' => 'integer',
        'scheduled_wait_where' => 'integer',
        'time' => TimeValueObjectCast::class
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted(): void
    {
        static::addGlobalScope(new UserScope());
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function trips(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Trip::class);
    }

    public function children(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Child::class);
    }

    public function toArray(): array
    {
        $data = parent::toArray();
        $data['crmid'] = $this->crmid?->toNative();
        $data['status'] = $this->status->value;
        $data['time'] = $this->time?->toNative();
        return $data;
    }

    public function toFullArray(): array
    {
        $data = parent::toArray();
        $data['crmid'] = $this->crmid;
        $data['created_at'] = $this->created_at ?? now();
        $data['updated_at'] = $this->updated_at ?? now();
        $data['status'] = $this->status;
        $data['time'] = $this->time;
        $data['date'] = $this->date;
        return $data;
    }

    public function toCrmArray(): array
    {
        $data = $this->toArray();
        unset(
            $data['crmid'],
            $data['id'],
            $data['created_at'],
            $data['updated_at'],
        );
        return $data;
    }

    protected static function newFactory(): TimetableFactory
    {
        return TimetableFactory::new();
    }
}
