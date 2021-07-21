<?php

declare(strict_types=1);

namespace Domains\Timetables\Tests\Feature;

use Domains\Authorization\Seeders\PermissionsSeeder;
use Domains\Children\Models\Child;
use Domains\Timetables\Http\Controllers\Api\TimetableApiController;
use Domains\Timetables\Http\Requests\Admin\DeleteTimetableRequest;
use Domains\Timetables\Http\Requests\Admin\IndexTimetablesRequest;
use Domains\Timetables\Http\Requests\Api\StoreTimetableApiRequest;
use Domains\Timetables\Http\Requests\Api\UpdateTimetableApiRequest;
use Domains\Timetables\Models\Timetable;
use Domains\Timetables\Repositories\Eloquent\TimetableRepository;
use Domains\Timetables\Repositories\TimetableRepositoryInterface;
use Domains\Users\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use JMac\Testing\Traits\AdditionalAssertions;
use Laravel\Sanctum\Sanctum;
use Parents\Tests\PhpUnit\TestCase;

class TimetableApiTest extends TestCase
{
    use RefreshDatabase, WithFaker, AdditionalAssertions;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_timetables_list(): void
    {
        $timetables = Timetable::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.timetables.index'));

        $response->assertOk()->assertJson(fn(AssertableJson $json) => $json
            ->has('data', 5, fn(AssertableJson $json) =>
            $json
                ->where('type', 'timetables')
                ->hasAll([
                    'id',
                    'attributes',
                    'type',
                    'attributes.name',
                    'attributes.where_address',
                    'attributes.trips',
                    'attributes.childrens',
                    'attributes.childrens_age',
                    'attributes.date',
                    'attributes.time',
                    'attributes.duration',
                    'attributes.distance',
                    'attributes.scheduled_wait_from',
                    'attributes.scheduled_wait_where',
                    'attributes.status',
                    'attributes.bill_paid',
                    'attributes.description',
                    'attributes.parking_info',
                    'attributes.user_id',
                ])->etc())->etc());
    }

    /**
     * @test
     */
    public function it_stores_the_timetable(): void
    {
        $data = Timetable::factory()
            ->make()
            ->toArray();
        $data['date'] = '2021-09-08';

        $response = $this->postJson(route('api.timetables.store'), [
            'data' => [
                'type' => 'timetables',
                'attributes' => $data
            ]
        ]);

        $this->assertDatabaseHas('timetables', $data);

        $response->assertStatus(201)->assertJson([
            'data' => [
                'type' => 'timetables',
                'attributes' => [
                    'name' => $data['name'],
                    'where_address' => $data['where_address']
                ]
            ]
        ]);
    }

    /**
     * @test
     */
    public function it_updates_the_timetable(): void
    {
        $timetable = Timetable::factory()->create();

        $user = User::factory()->create();

        $data = [
            'name' => $this->faker->address,
            'where_address' => $this->faker->address,
            'trips' => $this->faker->randomNumber(0),
            'childrens' => $this->faker->randomNumber(0),
            'childrens_age' => $this->faker->text(10),
            'date' => '2021-06-08',
            'time' => $this->faker->time,
            'duration' => $this->faker->randomNumber(0),
            'distance' => $this->faker->randomFloat(2, 0, 9999),
            'scheduled_wait_from' => $this->faker->randomNumber(0),
            'scheduled_wait_where' => $this->faker->randomNumber(0),
            'status' => 'Pending',
            'bill_paid' => $this->faker->boolean,
            'description' => $this->faker->sentence(15),
            'parking_info' => $this->faker->text,
            'user_id' => $user->id,
        ];

        $response = $this->putJson(
            route('api.timetables.update', $timetable),
            [
                'data' => [
                    'id' => (string) $timetable->id,
                    'type' => 'timetables',
                    'attributes' => $data
                ]
            ]
        );


        $this->assertDatabaseHas('timetables', $data);

        $response->assertStatus(202)->assertJson([
            'data' => [
                'type' => 'timetables',
                'attributes' => [
                    'name' => $data['name'],
                    'where_address' => $data['where_address']
                ]
            ]
        ]);
    }

    /**
     * @test
     */
    public function it_deletes_the_timetable(): void
    {
        $timetable = Timetable::factory()->create();

        $response = $this->deleteJson(
            route('api.timetables.destroy', $timetable)
        );

        $timetable->refresh();

        $this->assertSoftDeleted($timetable);

        $response->assertNoContent();
    }

    /**
     * @test
     */
    public function it_uses_correct_repository(): void
    {
        $repModel = app(TimetableRepositoryInterface::class);
        $this->assertInstanceOf(TimetableRepository::class, $repModel);
    }

    /**
     * @test
     */
    public function it_uses_middleware(): void
    {
        $this->assertRouteUsesMiddleware('api.timetables.index', ['auth:sanctum']);
    }

    /**
     * @test
     */
    public function it_uses_index_request(): void
    {
        $this->assertActionUsesFormRequest(
            TimetableApiController::class,
            'index',
            IndexTimetablesRequest::class
        );
    }

    /**
     * @test
     */
    public function store_timetable_create_request(): void
    {
        $this->assertActionUsesFormRequest(
            TimetableApiController::class,
            'store',
            StoreTimetableApiRequest::class
        );
    }

    /**
     * @test
     */
    public function update_uses_request(): void
    {
        $this->assertActionUsesFormRequest(
            TimetableApiController::class,
            'update',
            UpdateTimetableApiRequest::class
        );
    }

    /**
     * @test
     */
    public function delete_uses_request(): void
    {
        $this->assertActionUsesFormRequest(
            TimetableApiController::class,
            'destroy',
            DeleteTimetableRequest::class
        );
    }

    public function testGettingChildrenInclude(): void
    {
        /** @var Child $child */
        $child = Child::factory()->createOne();
        $timetable = Timetable::factory()->createOne();
        $timetable->children()->attach($child->id);
        $response = $this->getJson(route('api.timetables.show', [
            'timetable' => $timetable->id,
            'include' => 'children'
        ]));
        $response->assertOk()->assertJson(fn(AssertableJson $json) => $json
            ->has('data')
            ->where('data.type', 'timetables')
            ->where('data.id', (string) $timetable->id)
            ->has('included')
            ->where('included.0.type', 'children')
            ->where('included.0.id', (string) $child->id)
            ->etc()
        );
    }
}
