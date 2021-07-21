<?php

declare(strict_types=1);

namespace Domains\Payments\Models;

use Domains\Payments\Enums\SpStatusEnum;
use Domains\Payments\Enums\TypePaymentEnum;
use Domains\Payments\Factories\PaymentFactory;
use Domains\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Parents\Casts\CrmIdValueObjectCast;
use Parents\Casts\MoneyValueCast;
use Parents\Models\Model;
use Parents\Scopes\UserScope;
use Units\Filterings\Scopes\Searchable;

final class Payment extends Model
{
    use Searchable;

    public const RESOURCE_NAME = 'payments';

    public const DOMAIN_NAME = 'Payments';

    protected $fillable = [
        'pay_date',
        'type_payment',
        'amount',
        'spstatus',
        'user_id',
        'crmid'
    ];

    protected array $searchableFields = ['*'];

    protected $casts = [
        'pay_date' => 'date',
        'amount' => MoneyValueCast::class,
        'crmid' => CrmIdValueObjectCast::class,
        'type_payment' => TypePaymentEnum::class,
        'spstatus' => SpStatusEnum::class
    ];

    protected static function booted(): void
    {
        static::addGlobalScope(new UserScope());
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected static function newFactory(): PaymentFactory
    {
        return PaymentFactory::new();
    }

    public function toArray(): array
    {
        $data = parent::toArray();
        $data['amount'] = $this->amount->toFloat();
        $data['crmid'] = $this->crmid?->toNative();
        $data['type_payment'] = $this->type_payment->value;
        $data['spstatus'] = $this->spstatus->value;
        return $data;
    }

    public function toFullArray(): array
    {
        $data = parent::toArray();
        $data['amount'] = $this->amount;
        $data['crmid'] = $this->crmid;
        $data['type_payment'] = $this->type_payment;
        $data['spstatus'] = $this->spstatus;
        return $data;
    }
}
