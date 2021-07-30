<?php

declare(strict_types=1);

namespace Domains\Trips\Models;

use Domains\Attendants\Models\Attendant;
use Domains\Children\Models\Child;
use Domains\Timetables\Models\Timetable;
use Domains\Trips\Enums\TripStatusEnum;
use Domains\Trips\Factories\TripFactory;
use Domains\Users\Models\User;
use Parents\Casts\CrmIdValueObjectCast;
use Parents\Casts\MoneyValueCast;
use Parents\Casts\TimeValueObjectCast;
use Parents\Models\Model;
use Parents\Scopes\UserScope;
use Units\Filterings\Scopes\Searchable;

/**
 * Class Trip
 * @package Domains\Trips\Models
 * @property int $id
 * @property string $name Откуда
 * @property string $where_address Куда
 * @property \Illuminate\Support\Carbon $date Дата отправления
 * @property \Parents\ValueObjects\TimeValueObject|null $time Время отправления
 * @property int $childrens Количество детей
 * @property \Domains\Trips\Enums\TripStatusEnum $status Статус
 * @property int|null $attendant_id Сопровождающий
 * @property int|null $user_id Клиент
 * @property int $timetable_id Расписание
 * @property int $scheduled_wait_where Незапланированное время ожидания в точке Куда
 * @property int $scheduled_wait_from Незапланированное время ожидания в точке Откуда
 * @property \Parents\ValueObjects\MoneyValueObject|null $parking_cost Стоимость парковки
 * @property \Parents\ValueObjects\CrmIdValueObject|null $crmid ID in Vtiger
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Domains\Attendants\Models\Attendant|null $attendant
 * @property-read \Illuminate\Database\Eloquent\Collection|\Domains\Children\Models\Child[] $children
 * @property-read int|null $children_count
 * @property-read \Domains\Timetables\Models\Timetable $timetable
 * @property-read \Domains\Users\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Trip newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Trip newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Trip query()
 * @method static \Illuminate\Database\Eloquent\Builder|Trip search($search)
 * @method static \Illuminate\Database\Eloquent\Builder|Trip searchLatestPaginated(string $search, string $paginationQuantity = 10)
 * @method static \Illuminate\Database\Eloquent\Builder|Trip whereAttendantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trip whereChildrens($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trip whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trip whereCrmid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trip whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trip whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trip whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trip whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trip whereParkingCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trip whereScheduledWaitFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trip whereScheduledWaitWhere($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trip whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trip whereTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trip whereTimetableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trip whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trip whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trip whereWhereAddress($value)
 */
final class Trip extends Model
{
    use Searchable;

    public const RESOURCE_NAME = 'trips';

    public const DOMAIN_NAME = 'Trips';

    protected $fillable = [
        'name',
        'where_address',
        'date',
        'time',
        'childrens',
        'status',
        'attendant_id',
        'timetable_id',
        'scheduled_wait_where',
        'scheduled_wait_from',
        'parking_cost',
        'user_id',
        'crmid'
    ];

    protected array $searchableFields = ['*'];

    protected $casts = [
        'date' => 'date',
        'status' => TripStatusEnum::class,
        'childrens' => 'int',
        'parking_cost' => MoneyValueCast::class,
        'time' => TimeValueObjectCast::class,
        'scheduled_wait_from' => 'int',
        'scheduled_wait_where' => 'int',
        'crmid' => CrmIdValueObjectCast::class
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

    public function attendant(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Attendant::class);
    }

    public function timetable(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Timetable::class);
    }

    public function children(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Child::class);
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function toArray(): array
    {
        $data = parent::toArray();
        $data['time'] = $this->time?->toNative();
        $data['crmid'] = $this->crmid?->toNative();
        $data['parking_cost'] = $this->parking_cost?->toFloat();
        $data['status'] = $this->status->value;
        return $data;
    }

    public function toFullArray(): array
    {
        $data = parent::toArray();
        $data['time'] = $this->time;
        $data['crmid'] = $this->crmid;
        $data['parking_cost'] = $this->parking_cost;
        $data['status'] = $this->status;
        return $data;
    }

    protected static function newFactory(): TripFactory
    {
        return TripFactory::new();
    }
}
