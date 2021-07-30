<?php

declare(strict_types=1);

namespace Domains\Attendants\Tests\Feature;

use Domains\Attendants\Jobs\SendAttendantToVtigerJob;
use Domains\Attendants\Models\Attendant;
use Domains\Authorization\Seeders\PermissionsSeeder;
use Domains\Users\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Bus;
use Parents\Enums\GenderEnum;
use Parents\Tests\PhpUnit\TestCase;

class AttendantControllerTest extends TestCase
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
    public function it_displays_index_view_with_attendants(): void
    {
        /** @var Attendant[] $attendants */
        $attendants = Attendant::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('admin.attendants.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.attendants.index')
            ->assertViewHas('attendants');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_attendant(): void
    {
        $response = $this->get(route('admin.attendants.create'));

        $response->assertOk()->assertViewIs('app.attendants.create');
    }

    /**
     * @test
     * @psalm-suppress InvalidArrayOffset
     */
    public function it_stores_the_attendant(): void
    {
        Bus::fake();

        $data = Attendant::factory()
            ->make()
            ->toArray();
        $data['phone'] = '+79067865489';
        try {
            $response = $this->post(route('admin.attendants.store'), $data);
            $this->assertDatabaseHas('attendants', $data);
            /** @var Attendant $attendant */
            $attendant = Attendant::latest('id')->first();

            $response->assertRedirect(route('admin.attendants.edit', $attendant->id));
        } catch (\Illuminate\Validation\ValidationException $ex) {
            dump($ex->errors());
            $this->assertTrue(false, $ex->getMessage());
        }
        Bus::assertDispatched(SendAttendantToVtigerJob::class);
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_attendant(): void
    {
        /** @var Attendant $attendant */
        $attendant = Attendant::factory()->create();

        $response = $this->get(route('admin.attendants.show', $attendant->id));

        $response
            ->assertOk()
            ->assertViewIs('app.attendants.show')
            ->assertViewHas('attendant');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_attendant(): void
    {
        /** @var Attendant $attendant */
        $attendant = Attendant::factory()->create();

        $response = $this->get(route('admin.attendants.edit', $attendant->id));

        $response
            ->assertOk()
            ->assertViewIs('app.attendants.edit')
            ->assertViewHas('attendant');
    }

    /**
     * @test
     */
    public function it_updates_the_attendant(): void
    {
        Bus::fake();

        /** @var Attendant $attendant */
        $attendant = Attendant::factory()->create();

        $data = [
            'firstname' => $this->faker->firstName(),
            'lastname' => $this->faker->lastName(),
            'middle_name' => $this->faker->lastName(),
            'phone' => '+79086489965',
            'resume' => $this->faker->text(),
            'car_model' => $this->faker->text(190),
            'car_year' => $this->faker->year(),
            'email' => $this->faker->email(),
            'gender' => GenderEnum::getRandomValue(),
            'assigned_user_id' => '19x1',
        ];

        $response = $this->put(route('admin.attendants.update', $attendant->id), $data);

        $data['id'] = $attendant->id;

        $this->assertDatabaseHas('attendants', $data);

        $response->assertRedirect(route('admin.attendants.edit', $attendant->id));
        Bus::assertDispatched(SendAttendantToVtigerJob::class);
    }

    /**
     * @test
     */
    public function it_deletes_the_attendant(): void
    {
        /** @var Attendant $attendant */
        $attendant = Attendant::factory()->create();

        $response = $this->delete(route('admin.attendants.destroy', $attendant->id));

        $response->assertRedirect(route('admin.attendants.index'));

        $this->assertSoftDeleted($attendant);
    }
}
