<?php

declare(strict_types=1);

namespace Domains\Timetables\Tests\Feature;

use Domains\Authorization\Seeders\PermissionsSeeder;
use Domains\Children\Actions\GetChildrenIdsFromArrayAction;
use Domains\Children\Models\Child;
use Domains\Timetables\Actions\GetAllTimetablesAdminAction;
use Domains\Timetables\Actions\GetTimetableByIdAction;
use Domains\Timetables\Actions\GetTimetablesAction;
use Domains\Timetables\Actions\StoreTimetableAction;
use Domains\Timetables\Actions\UpdateTimetableAction;
use Domains\Timetables\DataTransferObjects\TimetableData;
use Domains\Timetables\Models\Timetable;
use Domains\Users\Models\User;
use Parents\Tests\PhpUnit\TestCase;

class TimetableActionTest extends TestCase
{
    public function testGettingAllTimetables(): void
    {
        Timetable::factory()->count(3)->create();
        /** @var Timetable[] $result */
        $result = GetAllTimetablesAdminAction::run();
        $this->assertCount(3, $result);
    }

    public function testTimetableIsRestrictedForClients(): void
    {
        $user1 = User::factory()->create(['email' => 'admin@admin.com']);

        $this->seed(PermissionsSeeder::class);

        $user = User::factory()->createOne();

        $this->actingAs(
            $user
        );

        Timetable::factory()->count(3)->create([
            'user_id' => $user1->id
        ]);
        Timetable::factory()->count(2)->create([
            'user_id' => $user->id
        ]);
        /** @var Timetable[] $result */
        $result = GetTimetablesAction::run();
        $this->assertCount(2, $result);
        /** @var Timetable[] $result */
        $result = GetAllTimetablesAdminAction::run();
        $this->assertCount(2, $result);
    }

    public function testGettingTimetableByIdRestrictedForClients(): void
    {
        $user1 = User::factory()->create(['email' => 'admin@admin.com']);

        $this->seed(PermissionsSeeder::class);

        $user = User::factory()->createOne();

        $this->actingAs(
            $user
        );

        $timetable1 = Timetable::factory()->createOne([
            'user_id' => $user1->id
        ]);
        $timetable2 = Timetable::factory()->createOne([
            'user_id' => $user->id
        ]);
        $result = GetTimetableByIdAction::run($timetable2->id);
        $this->assertEquals($timetable2->id, $result->id);
        $this->expectException(\Illuminate\Database\Eloquent\ModelNotFoundException::class);
        GetTimetableByIdAction::run($timetable1->id);
    }

    public function testStoreTimetableAction(): void
    {
        $child = Child::factory()->createOne();
        $timetableArr = Timetable::factory()->makeOne()->toFullArray();
        $timetableArr['children'] = [$child->id];
        $timetableData = new TimetableData($timetableArr);
        /** @var ?Timetable $result */
        $result = StoreTimetableAction::run($timetableData);
        $this->assertNotNull($result);
        $this->assertEquals($timetableData->name, $result->name);
        $this->assertCount(1, $result->children);
        $this->assertDatabaseHas('timetables', ['where_address' => $timetableData->where_address]);
    }

    public function testUpdateTimetableAction(): void
    {
        $child = Child::factory()->createOne([
            'crmid' => '22x443'
        ]);
        $timetable = Timetable::factory()->createOne();
        $timetableArr = $timetable->toFullArray();
        $timetableArr['children'] = GetChildrenIdsFromArrayAction::run([$child->crmid])->toArray();
        $timetableData = new TimetableData($timetableArr);
        $timetableData->name = 'changed data';
        $result = UpdateTimetableAction::run($timetableData);
        $timetable->refresh();
        $this->assertEquals('changed data', $timetable->name);
        $this->assertCount(1, $timetable->children);
    }
}
