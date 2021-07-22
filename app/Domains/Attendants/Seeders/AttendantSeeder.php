<?php

declare(strict_types=1);

namespace Domains\Attendants\Seeders;

use Domains\Attendants\Models\Attendant;
use Parents\Seeders\Seeder;

class AttendantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Attendant::factory()
            ->count(5)
            ->create();
    }
}
