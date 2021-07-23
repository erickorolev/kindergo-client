<?php

declare(strict_types=1);

namespace Domains\Trips\Tests\Feature;

use Domains\Attendants\Models\Attendant;
use Domains\Children\Models\Child;
use Domains\Timetables\Models\Timetable;
use Domains\Trips\Models\Trip;
use Domains\Users\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Parents\Tests\PhpUnit\TestCase;

class ModelRelationTest extends TestCase
{
    public function testAttendantRelationship(): void
    {
        $attendant = Attendant::factory()->create();
        $trip = Trip::factory()->create(['attendant_id' => $attendant->id]);

        $this->assertEquals($attendant->id, $trip->attendant_id);
        $this->assertInstanceOf(Attendant::class, $trip->attendant);
        $this->assertEquals($attendant->id, $trip->attendant->id);
    }

    public function testTimetableRelationship(): void
    {
        $timetable = Timetable::factory()->create();
        $trip = Trip::factory()->create(['timetable_id' => $timetable->id]);

        $this->assertEquals($timetable->id, $trip->timetable_id);
        $this->assertInstanceOf(Timetable::class, $trip->timetable);
        $this->assertEquals($timetable->id, $trip->timetable->id);
    }

    public function testUserRelationship(): void
    {
        $user = User::factory()->create();
        $trip = Trip::factory()->create(['user_id' => $user->id]);

        $this->assertEquals($user->id, $trip->user_id);
        $this->assertInstanceOf(User::class, $trip->user);
        $this->assertEquals($user->id, $trip->user->id);
    }

    public function testChildrenRelationship(): void
    {
        $trip = Trip::factory()->create();
        $child = Child::factory()->create();
        $trip->children()->attach($child);

        $this->assertInstanceOf(Collection::class, $trip->children);
        $this->assertInstanceOf(Child::class, $trip->children->first());
        $this->assertEquals($child->id, $trip->children->first()->id);
    }
}
