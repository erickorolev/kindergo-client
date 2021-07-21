<?php

declare(strict_types=1);

namespace Domains\Payments\Http\Requests\Admin;

use BenSampo\Enum\Rules\EnumValue;
use Domains\Payments\Enums\SpStatusEnum;
use Domains\Payments\Enums\TypePaymentEnum;
use Parents\Requests\Request;

final class PaymentStoreRequest extends Request
{
    public function rules(): array
    {
        return [
            'pay_date' => ['required', 'date'],
            'type_payment' => ['required', new EnumValue(TypePaymentEnum::class)],
            'amount' => ['required', 'numeric'],
            'spstatus' => [
                'required',
                new EnumValue(SpStatusEnum::class),
            ],
            'user_id' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return $this->check('create payments');
    }
}
