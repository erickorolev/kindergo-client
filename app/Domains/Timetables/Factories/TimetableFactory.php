<?php

declare(strict_types=1);

namespace Domains\Timetables\Factories;

use Domains\Timetables\Enums\TimetableStatusEnum;
use Domains\Timetables\Models\Timetable;
use Domains\Users\Models\User;
use Parents\Factories\Factory;
use Parents\ValueObjects\TimeValueObject;

final class TimetableFactory extends Factory
{
    protected $model = Timetable::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->address,
            'where_address' => $this->faker->address,
            'trips' => $this->faker->randomNumber(0),
            'childrens' => $this->faker->randomNumber(0),
            'childrens_age' => $this->faker->text(10),
            'date' => $this->faker->date,
            'time' => TimeValueObject::fromNative($this->faker->time),
            'duration' => $this->faker->randomNumber(0),
            'distance' => $this->faker->randomFloat(2, 0, 9999),
            'scheduled_wait_from' => $this->faker->randomNumber(0),
            'scheduled_wait_where' => $this->faker->randomNumber(0),
            'status' => TimetableStatusEnum::getRandomInstance(),
            'bill_paid' => $this->faker->boolean,
            'description' => $this->faker->sentence(15),
            'parking_info' => $this->faker->text,
            'user_id' => User::factory(),
        ];
    }
}
