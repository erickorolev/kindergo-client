<?php

declare(strict_types=1);

namespace Domains\Timetables\Tests\Feature;

use Domains\Children\Models\Child;
use Domains\Timetables\Models\Timetable;
use Domains\Users\Models\User;
use Parents\Tests\PhpUnit\TestCase;
use Illuminate\Database\Eloquent\Collection;

class ModelRelationTest extends TestCase
{
    public function testUserBelongsToTimetable(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        /** @var Timetable $timetable */
        $timetable = Timetable::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $timetable->user);
        $this->assertEquals($user->id, $timetable->user_id);
        $this->assertEquals($user->id, $timetable->user->id);
    }

    public function testTimetableHasManyChildren(): void
    {
        /** @var Timetable $timetable */
        $timetable = Timetable::factory()->create();
        /** @var Child $child */
        $child = Child::factory()->create();
        $timetable->children()->attach($child);

        $this->assertInstanceOf(Collection::class, $timetable->children);
        $this->assertInstanceOf(Child::class, $timetable->children->first());
        $this->assertEquals($child->id, $timetable->children->first()?->id);
    }
}
