<?php

declare(strict_types=1);

namespace Database\Seeders;

use Domains\Authorization\Seeders\PermissionsSeeder;
use Domains\Children\Seeders\ChildSeeder;
use Domains\Timetables\Seeders\TimetableSeeder;
use Domains\Users\Seeders\UserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(PermissionsSeeder::class);
        $this->call(ChildSeeder::class);
        $this->call(TimetableSeeder::class);
    }
}
