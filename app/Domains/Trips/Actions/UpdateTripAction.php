<?php

declare(strict_types=1);

namespace Domains\Trips\Actions;

use Domains\Trips\DataTransferObjects\TripData;
use Domains\Trips\Models\Trip;

final class UpdateTripAction extends \Parents\Actions\Action
{
    public function handle(TripData $data): Trip
    {
        /** @var Trip $trip */
        $trip = GetTripByIdAction::run($data->id);
        $trip->update($data->toArray());
        if ($data->children) {
            $trip->children()->sync($data->children);
        }
        return $trip;
    }
}
