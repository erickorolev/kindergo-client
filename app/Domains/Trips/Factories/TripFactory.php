<?php

declare(strict_types=1);

namespace Domains\Trips\Factories;

use Domains\Attendants\Models\Attendant;
use Domains\Timetables\Models\Timetable;
use Domains\Trips\Enums\TripStatusEnum;
use Domains\Trips\Models\Trip;
use Domains\Users\Models\User;
use Illuminate\Support\Carbon;
use Parents\Factories\Factory;
use Parents\ValueObjects\CrmIdValueObject;
use Parents\ValueObjects\TimeValueObject;

final class TripFactory extends Factory
{
    protected $model = Trip::class;

    /**
     * Define the model's default state.
     *
     * @return array
     * @psalm-suppress UndefinedMagicPropertyFetch
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->address(),
            'where_address' => $this->faker->address(),
            'date' => Carbon::now(),
            'time' => TimeValueObject::fromNative($this->faker->time()),
            'childrens' => $this->faker->randomNumber(1),
            'status' => TripStatusEnum::getRandomInstance(),
            'attendant_id' => function (): int {
                return Attendant::factory()->create()->id;
            },
            'user_id' => function (): int {
                return User::factory()->create()->id;
            },
            'scheduled_wait_where' => $this->faker->randomNumber(2),
            'scheduled_wait_from' => $this->faker->randomNumber(2),
            'parking_cost' => $this->faker->randomNumber(5),
            'crmid' => CrmIdValueObject::fromNative(
                $this->faker->randomNumber(2) . 'x' . $this->faker->randomNumber(3)
            ),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'timetable_id' => function (): int {
                return Timetable::factory()->create()->id;
            },
        ];
    }
}
