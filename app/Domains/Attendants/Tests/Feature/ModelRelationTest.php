<?php

declare(strict_types=1);

namespace Domains\Attendants\Tests\Feature;

use Domains\Attendants\Models\Attendant;
use Domains\Trips\Models\Trip;
use Illuminate\Database\Eloquent\Collection;
use Parents\Tests\PhpUnit\TestCase;

class ModelRelationTest extends TestCase
{
    public function testTripsRelation(): void
    {
        /** @var Attendant $attendant */
        $attendant = Attendant::factory()->createOne();
        /** @var Trip $trip */
        $trip = Trip::factory()->createOne([
            'attendant_id' => $attendant->id
        ]);

        $this->assertInstanceOf(Collection::class, $attendant->trips);
        $this->assertInstanceOf(Trip::class, $attendant->trips->first());
        $this->assertEquals($trip->id, $attendant->trips->first()->id);
    }
}
