<?php

declare(strict_types=1);

namespace Domains\Payments\Tests\Feature;

use Domains\Authorization\Seeders\PermissionsSeeder;
use Domains\Payments\Enums\SpStatusEnum;
use Domains\Payments\Enums\TypePaymentEnum;
use Domains\Payments\Models\Payment;
use Domains\Users\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Parents\Tests\PhpUnit\TestCase;

class PaymentControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

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
    public function it_displays_index_view_with_payments(): void
    {
        /** @var Payment[] $payments */
        $payments = Payment::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('admin.payments.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.payments.index')
            ->assertViewHas('payments');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_payment(): void
    {
        $response = $this->get(route('admin.payments.create'));

        $response->assertOk()->assertViewIs('app.payments.create');
    }

    /**
     * @test
     */
    public function it_stores_the_payment(): void
    {
        $data = Payment::factory()
            ->make()
            ->toArray();
        $data['pay_date'] = '2021-05-08';

        $response = $this->post(route('admin.payments.store'), $data);
        $data['amount'] = $data['amount'] * 100;
        $this->assertDatabaseHas('payments', $data);

        $payment = Payment::latest('id')->first();

        $response->assertRedirect(route('admin.payments.edit', $payment->id));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_payment(): void
    {
        $payment = Payment::factory()->create();

        $response = $this->get(route('admin.payments.show', $payment->id));

        $response
            ->assertOk()
            ->assertViewIs('app.payments.show')
            ->assertViewHas('payment');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_payment(): void
    {
        /** @var Payment $payment */
        $payment = Payment::factory()->create();

        $response = $this->get(route('admin.payments.edit', $payment->id));

        $response
            ->assertOk()
            ->assertViewIs('app.payments.edit')
            ->assertViewHas('payment');
    }

    /**
     * @test
     */
    public function it_updates_the_payment(): void
    {
        $payment = Payment::factory()->create();

        $user = User::factory()->create();

        $data = [
            'pay_date' => '2021-08-09',
            'type_payment' => TypePaymentEnum::getRandomValue(),
            'amount' => $this->faker->randomNumber,
            'spstatus' => SpStatusEnum::getRandomValue(),
            'user_id' => $user->id,
        ];

        $response = $this->put(route('admin.payments.update', $payment->id), $data);

        $data['id'] = $payment->id;
        $data['amount'] = $data['amount'] * 100;
        $this->assertDatabaseHas('payments', $data);

        $response->assertRedirect(route('admin.payments.edit', $payment->id));
    }

    /**
     * @test
     */
    public function it_deletes_the_payment(): void
    {
        $payment = Payment::factory()->create();

        $response = $this->delete(route('admin.payments.destroy', $payment));

        $response->assertRedirect(route('admin.payments.index'));

        $this->assertSoftDeleted($payment);
    }
}
