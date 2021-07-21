<?php

declare(strict_types=1);

namespace Domains\Payments\Http\Requests\Api;

use BenSampo\Enum\Rules\EnumValue;
use Domains\Payments\Enums\SpStatusEnum;
use Domains\Payments\Enums\TypePaymentEnum;
use Parents\Requests\Request;

final class PaymentStoreApiRequest extends Request
{
    public function rules(): array
    {
        $rules = [
            'data.attributes.pay_date' => ['required', 'date'],
            'data.attributes.type_payment' => ['required', new EnumValue(TypePaymentEnum::class)],
            'data.attributes.amount' => ['required', 'numeric'],
            'data.attributes.spstatus' => [
                'required',
                new EnumValue(SpStatusEnum::class),
            ],
            'data.attributes.user_id' => ['required'],
        ];
        return $this->mergeWithDefaultRules($rules);
    }

    public function authorize(): bool
    {
        return $this->check('create payments');
    }
}
