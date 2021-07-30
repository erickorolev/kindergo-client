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

/**
 * Class Payment
 * @package Domains\Payments\Models
 * @property int $id
 * @property \Illuminate\Support\Carbon $pay_date Дата платежа
 * @property \Domains\Payments\Enums\TypePaymentEnum $type_payment Вид оплаты
 * @property \Parents\ValueObjects\MoneyValueObject|null $amount Сумма в копейках
 * @property \Domains\Payments\Enums\SpStatusEnum $spstatus Статус
 * @property int $user_id Контакт
 * @property \Parents\ValueObjects\CrmIdValueObject|null $crmid ID in Vtiger
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Domains\Users\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment search($search)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment searchLatestPaginated(string $search, string $paginationQuantity = 10)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereCrmid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment wherePayDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereSpstatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereTypePayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereUserId($value)
 */
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
        $data['amount'] = $this->amount?->toFloat();
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
