<?php

declare(strict_types=1);

namespace Domains\Timetables\Seeders;

use Domains\Timetables\Models\Timetable;
use Parents\Seeders\Seeder;

final class TimetableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Timetable::factory()
            ->count(5)
            ->create();
    }
}
