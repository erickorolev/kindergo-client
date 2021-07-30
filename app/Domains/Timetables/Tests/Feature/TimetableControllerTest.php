<?php

declare(strict_types=1);

namespace Domains\Timetables\Tests\Feature;

use Domains\Authorization\Seeders\PermissionsSeeder;
use Domains\Timetables\Enums\TimetableStatusEnum;
use Domains\Timetables\Models\Timetable;
use Domains\Users\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Parents\Tests\PhpUnit\TestCase;
use Ramsey\Uuid\Type\Time;

class TimetableControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        /** @var User $user */
        $user = User::factory()->create(['email' => 'admin@admin.com']);
        $this->actingAs(
            $user
        );

        $this->seed(PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_timetables(): void
    {
        /** @var Timetable[] $timetables */
        $timetables = Timetable::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('admin.timetables.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.timetables.index')
            ->assertViewHas('timetables');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_timetable(): void
    {
        $response = $this->get(route('admin.timetables.create'));

        $response->assertOk()->assertViewIs('app.timetables.create');
    }

    /**
     * @test
     * @psalm-suppress InvalidArrayOffset
     */
    public function it_stores_the_timetable(): void
    {
        $data = Timetable::factory()
            ->make()
            ->toArray();
        $data['date'] = '2021-06-08';

        $response = $this->post(route('admin.timetables.store'), $data);

        $this->assertDatabaseHas('timetables', $data);

        /** @var Timetable $timetable */
        $timetable = Timetable::latest('id')->first();

        $response->assertRedirect(route('admin.timetables.edit', $timetable));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_timetable(): void
    {
        /** @var Timetable $timetable */
        $timetable = Timetable::factory()->create();

        $response = $this->get(route('admin.timetables.show', $timetable));

        $response
            ->assertOk()
            ->assertViewIs('app.timetables.show')
            ->assertViewHas('timetable');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_timetable(): void
    {
        /** @var Timetable $timetable */
        $timetable = Timetable::factory()->create();

        $response = $this->get(route('admin.timetables.edit', $timetable->id));

        $response
            ->assertOk()
            ->assertViewIs('app.timetables.edit')
            ->assertViewHas('timetable');
    }

    /**
     * @test
     */
    public function it_updates_the_timetable(): void
    {
        /** @var Timetable $timetable */
        $timetable = Timetable::factory()->create();
        /** @var User $user */
        $user = User::factory()->create();

        $data = [
            'name' => $this->faker->address(),
            'where_address' => $this->faker->address(),
            'trips' => $this->faker->randomNumber(0),
            'childrens' => $this->faker->randomNumber(0),
            'childrens_age' => $this->faker->text(10),
            'date' => $this->faker->date(),
            'time' => $this->faker->time(),
            'duration' => $this->faker->randomNumber(0),
            'distance' => $this->faker->randomFloat(2, 0, 9999),
            'scheduled_wait_from' => $this->faker->randomNumber(0),
            'scheduled_wait_where' => $this->faker->randomNumber(0),
            'status' => TimetableStatusEnum::getRandomValue(),
            'bill_paid' => $this->faker->boolean(),
            'description' => $this->faker->sentence(15),
            'parking_info' => $this->faker->text(),
            'user_id' => $user->id,
            'assigned_user_id' => '19x1'
        ];

        $response = $this->put(route('admin.timetables.update', $timetable), $data);

        $data['id'] = $timetable->id;

        $this->assertDatabaseHas('timetables', $data);

        $response->assertRedirect(route('admin.timetables.edit', $timetable->id));
    }

    /**
     * @test
     */
    public function it_deletes_the_timetable(): void
    {
        /** @var Timetable $timetable */
        $timetable = Timetable::factory()->create();

        $response = $this->delete(route('admin.timetables.destroy', $timetable));

        $response->assertRedirect(route('admin.timetables.index'));

        $this->assertSoftDeleted($timetable);
    }
}
