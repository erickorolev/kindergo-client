<?php

declare(strict_types=1);

namespace Domains\Attendants\Tests\Feature;

use Domains\Attendants\Http\Requests\Api\AttendantStoreApiRequest;
use Domains\Attendants\Http\Requests\Api\AttendantUpdateApiRequest;
use Domains\Authorization\Seeders\PermissionsSeeder;
use Domains\Attendants\Http\Controllers\Api\AttendantApiController;
use Domains\Attendants\Http\Requests\Admin\DeleteAttendantRequest;
use Domains\Attendants\Http\Requests\Admin\IndexAttendantRequest;
use Domains\Attendants\Models\Attendant;
use Domains\Attendants\Repositories\AttendantRepositoryInterface;
use Domains\Attendants\Repositories\Eloquent\AttendantRepository;
use Domains\TemporaryFile\Actions\UploadFileAction;
use Domains\Trips\Models\Trip;
use Domains\Users\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Testing\Fluent\AssertableJson;
use JMac\Testing\Traits\AdditionalAssertions;
use Laravel\Sanctum\Sanctum;
use Parents\Tests\PhpUnit\TestCase;

class AttendantApiTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    use AdditionalAssertions;

    protected function setUp(): void
    {
        parent::setUp();
        /** @var User $user */
        $user = User::factory()->create([
            'email' => 'admin@admin.com',
            'phone' => '+79067598835',
            'otherphone' => '+79087756389'
        ]);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_attendants_list(): void
    {
        Attendant::factory()
            ->count(5)
            ->create([
                'phone' => '+79025689922',
            ]);

        $response = $this->getJson(route('api.attendants.index'));

        $response->assertOk()->assertJson(fn(AssertableJson $json) => $json
            ->has('data', 5, fn(AssertableJson $json) =>
            $json
                ->where('type', 'attendants')
                ->hasAll([
                    'id',
                    'attributes',
                    'type',
                    'attributes.firstname',
                    'attributes.lastname',
                    'attributes.middle_name',
                    'attributes.phone',
                    'attributes.gender',
                    'attributes.gender.value',
                    'attributes.gender.description',
                    'attributes.media',
                ])->etc())->etc());
    }

    /**
     * @test
     */
    public function it_uses_correct_repository(): void
    {
        $repModel = app(AttendantRepositoryInterface::class);
        $this->assertInstanceOf(AttendantRepository::class, $repModel);
    }

    /**
     * @test
     */
    public function it_uses_middleware(): void
    {
        $this->assertRouteUsesMiddleware('api.attendants.index', ['auth:sanctum']);
    }

    /**
     * @test
     */
    public function it_uses_index_request(): void
    {
        $this->assertActionUsesFormRequest(
            AttendantApiController::class,
            'index',
            IndexAttendantRequest::class
        );
    }

    /**
     * @test
     * @psalm-suppress InvalidArrayOffset
     */
    public function it_stores_the_attendant(): void
    {
        $data = Attendant::factory()
            ->make()
            ->toArray();
        $data['phone'] = '+79876757706';

        try {
            $response = $this->postJson(route('api.attendants.store'), [
                'data' => [
                    'type' => 'attendants',
                    'attributes' => $data
                ]
            ]);
            unset($data['imagename']);

            $this->assertDatabaseHas('attendants', $data);

            $response->assertStatus(201)->assertJson([
                'data' => [
                    'attributes' => [
                        'firstname' => $data['firstname'],
                        'lastname' => $data['lastname'],
                        'crmid' => $data['crmid'],
                        'phone' => '8 (987) 675-77-06',
                        'car_model' => $data['car_model'],
                        'car_year' => $data['car_year'],
                        'resume' => $data['resume'],
                    ]
                ]
            ]);
        } catch (\Illuminate\Validation\ValidationException $ex) {
            dump($ex->errors());
            $this->assertTrue(false, $ex->getMessage());
        }
    }

    /**
     * @test
     */
    public function store_attendant_create_request(): void
    {
        $this->assertActionUsesFormRequest(
            AttendantApiController::class,
            'store',
            AttendantStoreApiRequest::class
        );
    }

    /**
     * @test
     */
    public function store_controller_uses_middleware(): void
    {
        $this->assertRouteUsesMiddleware('api.attendants.store', ['auth:sanctum']);
    }

    /**
     * @test
     */
    public function it_updates_the_attendant(): void
    {
        /** @var Attendant $user */
        $user = Attendant::factory()->create();

        $data = [
            'data' => [
                'type' => 'attendants',
                'id' => (string) $user->id,
                'attributes' => [
                    'firstname' => $this->faker->firstName(),
                    'lastname' => $this->faker->lastName(),
                    'email' => $user->email?->toNative(),
                    'middle_name' => $this->faker->text(10),
                    'phone' => '+79876757777',
                    'gender' => 'Male',
                    'resume' => $this->faker->text(),
                    'car_model' => $this->faker->company(),
                    'car_year' => $this->faker->year()
                ]
            ]
        ];

        $response = $this->putJson(route('api.attendants.update', ['attendant' => $user->id]), $data);

        $this->assertDatabaseHas('attendants', [
            'id' => $user->id,
            'middle_name' => $data['data']['attributes']['middle_name']
        ]);
        $user->refresh();

        $response->assertStatus(202)->assertJson([
            'data' => [
                'attributes' => [
                ]
            ]
        ]);
        $this->assertEquals($data['data']['attributes']['middle_name'], $user->middle_name);
        $this->assertEquals($data['data']['attributes']['firstname'], $user->firstname);
        $this->assertEquals($data['data']['attributes']['lastname'], $user->lastname);
        $this->assertEquals($data['data']['attributes']['phone'], $user->phone?->toNative());
        $this->assertEquals($data['data']['attributes']['resume'], $user->resume);
    }

    /**
     * @test
     */
    public function update_uses_create_request(): void
    {
        $this->assertActionUsesFormRequest(
            AttendantApiController::class,
            'update',
            AttendantUpdateApiRequest::class
        );
    }

    /**
     * @test
     */
    public function update_controller_uses_middleware(): void
    {
        $this->assertRouteUsesMiddleware('api.attendants.update', ['auth:sanctum']);
    }

    /**
     * @test
     */
    public function it_deletes_the_user(): void
    {
        /** @var Attendant $user */
        $user = Attendant::factory()->create();

        $response = $this->deleteJson(route('api.attendants.destroy', $user));

        $this->assertSoftDeleted($user);

        $response->assertNoContent();
    }

    /**
     * @test
     */
    public function delete_uses_create_request(): void
    {
        $this->assertActionUsesFormRequest(
            AttendantApiController::class,
            'destroy',
            DeleteAttendantRequest::class
        );
    }

    /**
     * @test
     */
    public function delete_controller_uses_middleware(): void
    {
        $this->assertRouteUsesMiddleware('api.attendants.destroy', ['auth:sanctum']);
    }

    /**
     * @test
     * @psalm-suppress InvalidArrayOffset
     */
    public function testImagesAdding(): void
    {
        $file = UploadedFile::fake()->create('test.pdf', 100, 'application/pdf');
        $result = UploadFileAction::run($file);
        $this->assertFileExists(storage_path('app/public/uploads/tmp/' . $result . '/test.pdf'));
        /** @var Attendant $user */
        $user = Attendant::factory()->makeOne([
            'phone' => '+79086447896',
        ]);
        $userData = $user->toArray();
        $userData['file'] = $result;
        try {
            $response = $this->postJson(route('api.attendants.store'), [
                'data' => [
                    'type' => 'attendants',
                    'attributes' => $userData
                ]
            ], [
                'Accept' => 'application/vnd.api+json',
                'Content-Type' => 'application/vnd.api+json'
            ]);
            $response->assertSessionDoesntHaveErrors();
            $response->assertCreated();
            $response->assertJson(fn(AssertableJson $json) =>
            $json->has('data')->has('data.id')->has('data.type')
                ->has('data.attributes.media')
                ->count('data.attributes.media', 1)
                ->etc());
        } catch (\Illuminate\Validation\ValidationException $exception) {
            dump($exception->errors());
            $this->assertTrue(false, $exception->getMessage());
        }


        $this->assertDatabaseHas('attendants', [
            'firstname' => $user->firstname,
            'lastname' => $user->lastname
        ]);
        $this->assertDatabaseHas('media', [
            'collection_name' => 'avatar',
            'model_type' => 'Domains\Attendants\Models\Attendant'
        ]);
    }

    public function testGettingTripsInclude(): void
    {
        /** @var Attendant $attendant */
        $attendant = Attendant::factory()->createOne([
            'phone' => '+79876689875',
        ]);
        /** @var Trip $trip */
        $trip = Trip::factory()->createOne([
            'attendant_id' => $attendant->id
        ]);
        $response = $this->getJson(route('api.attendants.show', [
            'attendant' => $attendant->id,
            'include' => 'trips'
        ]));
        $response->assertOk()->assertJson(fn(AssertableJson $json) => $json
            ->has('data')
            ->where('data.type', 'attendants')
            ->where('data.id', (string) $attendant->id)
            ->has('included')
            ->where('included.0.type', 'trips')
            ->where('included.0.id', (string) $trip->id)
            ->etc());
    }

    public function testGettingRelatedUsersFromAttendant(): void
    {
        /** @var Attendant $attendant */
        $attendant = Attendant::factory()->createOne([
            'phone' => '+79876689875',
        ]);
        /** @var Trip $trip */
        $trip = Trip::factory()->createOne([
            'attendant_id' => $attendant->id
        ]);
        $response = $this->getJson(route('api.attendants.relations', [
            'id' => $attendant->id,
            'relation' => 'trips'
        ]));
        $response->assertOk()->assertJson(fn(AssertableJson $json) => $json
            ->has('data', 1, fn(AssertableJson $json) =>
            $json
                ->where('type', 'trips')
                ->hasAll([
                    'id',
                    'attributes',
                    'type',
                    'attributes.name',
                    'attributes.childrens',
                    'attributes.date',
                    'attributes.time'
                ])->etc())->etc());
    }
}
