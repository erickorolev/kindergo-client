<?php

namespace Domains\Users\Factories;

use Domains\Users\Enums\AttendantGenderEnum;
use Domains\Users\Models\User;
use Domains\Users\ValueObjects\FullNameValueObject;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Parents\ValueObjects\CrmIdValueObject;
use Parents\ValueObjects\EmailValueObject;
use Parents\ValueObjects\PhoneNumberValueObject;
use Parents\ValueObjects\UrlValueObject;

final class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => FullNameValueObject::fromNative($this->faker->firstName, $this->faker->lastName, null),
            'email' => $this->faker->email,
            'email_verified_at' => now(),
            'password' => \Hash::make('password'),
            'remember_token' => Str::random(10),
            'firstname' => $this->faker->firstName,
            'lastname' => $this->faker->lastName,
            'middle_name' => $this->faker->lastName,
            'phone' => PhoneNumberValueObject::fromNative($this->faker->phoneNumber),
            'attendant_gender' => AttendantGenderEnum::getRandomInstance(),
            'otherphone' => PhoneNumberValueObject::fromNative($this->faker->phoneNumber),
            'crmid' => CrmIdValueObject::fromNative($this->faker->randomNumber(2) . 'x' . $this->faker->randomNumber(3)),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
