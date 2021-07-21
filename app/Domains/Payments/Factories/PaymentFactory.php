<?php

declare(strict_types=1);

namespace Domains\Payments\Factories;

use Domains\Payments\Enums\SpStatusEnum;
use Domains\Payments\Enums\TypePaymentEnum;
use Domains\Payments\Models\Payment;
use Domains\Users\Models\User;
use Illuminate\Support\Carbon;
use Parents\Factories\Factory;
use Parents\ValueObjects\CrmIdValueObject;
use Parents\ValueObjects\MoneyValueObject;

final class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'pay_date' => Carbon::now(),
            'type_payment' => TypePaymentEnum::getRandomInstance(),
            'amount' => MoneyValueObject::fromNative($this->faker->numberBetween(10000, 1000000)),
            'spstatus' => SpStatusEnum::getRandomInstance(),
            'crmid' => CrmIdValueObject::fromNative($this->faker->randomNumber(2) . 'x' . $this->faker->randomNumber(3)),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'user_id' => function () {
                return User::factory()->create()->id;
            },
        ];
    }
}
