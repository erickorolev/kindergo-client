<?php

declare(strict_types=1);

namespace Domains\Timetables\Models;

use Domains\Children\Models\Child;
use Domains\Timetables\Enums\TimetableStatusEnum;
use Domains\Timetables\Factories\TimetableFactory;
use Domains\Users\Factories\UserFactory;
use Domains\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Parents\Casts\CrmIdValueObjectCast;
use Parents\Casts\TimeValueObjectCast;
use Parents\Models\Model;
use Units\Filterings\Scopes\Searchable;

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

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function trips()
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
        $data['status'] = $this->status?->value;
        $data['time'] = $this->time->toNative();
        return $data;
    }

    public function toFullArray(): array
    {
        $data = parent::toArray();
        $data['crmid'] = $this->crmid?->toNative();
        $data['created_at'] = $this->created_at ?? now();
        $data['updated_at'] = $this->updated_at ?? now();
        $data['status'] = $this->status;
        $data['time'] = $this->time;
        return $data;
    }

    protected static function newFactory(): TimetableFactory
    {
        return TimetableFactory::new();
    }
}
