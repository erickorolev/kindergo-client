<?php

declare(strict_types=1);

namespace Domains\Trips\Tests\Feature;

use Domains\Attendants\Models\Attendant;
use Domains\Authorization\Seeders\PermissionsSeeder;
use Domains\Children\Models\Child;
use Domains\Timetables\Models\Timetable;
use Domains\Trips\Enums\TripStatusEnum;
use Domains\Trips\Models\Trip;
use Domains\Users\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Parents\Tests\PhpUnit\TestCase;

class TripControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_trips(): void
    {
        $trips = Trip::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('admin.trips.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.trips.index')
            ->assertViewHas('trips');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_trip(): void
    {
        $response = $this->get(route('admin.trips.create'));

        $response->assertOk()->assertViewIs('app.trips.create');
    }

    /**
     * @test
     */
    public function it_stores_the_trip(): void
    {
        /** @var Child $child */
        $child = Child::factory()->createOne();

        $data = Trip::factory()
            ->make()
            ->toArray();

        $data['date'] = '2021-08-06';
        $data['children'] = [$child->id];

        $response = $this->post(route('admin.trips.store'), $data);

        $data['parking_cost'] = $data['parking_cost'] * 100;
        unset($data['created_at']);
        unset($data['updated_at']);
        unset($data['children']);

        $this->assertDatabaseHas('trips', $data);

        $trip = Trip::latest('id')->first();
        $this->assertCount(1, $trip->children);

        $response->assertRedirect(route('admin.trips.edit', $trip));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_trip(): void
    {
        $trip = Trip::factory()->create();

        $response = $this->get(route('admin.trips.show', $trip));

        $response
            ->assertOk()
            ->assertViewIs('app.trips.show')
            ->assertViewHas('trip');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_trip(): void
    {
        /** @var Trip $trip */
        $trip = Trip::factory()->create();

        $response = $this->get(route('admin.trips.edit', $trip->id));

        $response
            ->assertOk()
            ->assertViewIs('app.trips.edit')
            ->assertViewHas('trip');
    }

    /**
     * @test
     */
    public function it_updates_the_trip(): void
    {
        $user = User::first();
        $trip = Trip::factory()->create([
            'user_id' => $user->id
        ]);
        /** @var Attendant $attendant */
        $attendant = Attendant::factory()->create();
        /** @var Timetable $timetable */
        $timetable = Timetable::factory()->create();

        $data = [
            'name' => $this->faker->address,
            'where_address' => $this->faker->address,
            'date' => '2021-06-05',
            'time' => $this->faker->time,
            'childrens' => $this->faker->randomNumber(1),
            'status' => TripStatusEnum::getRandomValue(),
            'scheduled_wait_where' => $this->faker->randomNumber(1),
            'scheduled_wait_from' => $this->faker->randomNumber(1),
            'parking_cost' => $this->faker->randomNumber(3),
            'attendant_id' => $attendant->id,
            'timetable_id' => $timetable->id,
        ];

        $response = $this->put(route('admin.trips.update', $trip), $data);

        $data['id'] = $trip->id;
        $data['parking_cost'] = $data['parking_cost'] * 100;
        unset($data['created_at']);
        unset($data['updated_at']);

        $this->assertDatabaseHas('trips', $data);

        $response->assertRedirect(route('admin.trips.edit', $trip->id));
    }

    /**
     * @test
     */
    public function it_deletes_the_trip(): void
    {
        $trip = Trip::factory()->create();

        $response = $this->delete(route('admin.trips.destroy', $trip));

        $response->assertRedirect(route('admin.trips.index'));

        $this->assertSoftDeleted($trip);
    }
}
