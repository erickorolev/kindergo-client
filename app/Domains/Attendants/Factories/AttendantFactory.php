<?php

declare(strict_types=1);

namespace Domains\Attendants\Factories;

use Domains\Attendants\Models\Attendant;
use Illuminate\Support\Carbon;
use Parents\Enums\GenderEnum;
use Parents\Factories\Factory;
use Parents\ValueObjects\CrmIdValueObject;
use Parents\ValueObjects\EmailValueObject;
use Parents\ValueObjects\PhoneNumberValueObject;

final class AttendantFactory extends Factory
{
    protected $model = Attendant::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'firstname' => $this->faker->firstName,
            'lastname' => $this->faker->lastName,
            'middle_name' => $this->faker->name,
            'phone' => PhoneNumberValueObject::fromNative($this->faker->phoneNumber),
            'resume' => $this->faker->text,
            'car_model' => $this->faker->word,
            'car_year' => $this->faker->year,
            'email' => EmailValueObject::fromNative($this->faker->unique()->safeEmail),
            'gender' => GenderEnum::getRandomInstance(),
            'crmid' => CrmIdValueObject::fromNative(
                $this->faker->randomNumber(2) . 'x' . $this->faker->randomNumber(3)
            ),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
