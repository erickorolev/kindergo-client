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
use Units\Filterings\Scopes\Searchable;

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
        $data['time'] = $this->time->toNative();
        $data['crmid'] = $this->crmid?->toNative();
        $data['parking_cost'] = $this->parking_cost->toFloat();
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
