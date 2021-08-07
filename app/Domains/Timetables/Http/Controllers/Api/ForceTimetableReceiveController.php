<?php

declare(strict_types=1);

namespace Domains\Timetables\Http\Controllers\Api;

use Domains\Timetables\Actions\ReceiveTimetableFromCrmAction;
use Domains\Timetables\Models\Timetable;
use Domains\Timetables\Transformers\TimetableTransformer;
use Parents\Controllers\Controller;
use Parents\Serializers\JsonApiSerializer;

final class ForceTimetableReceiveController extends Controller
{
    public function __invoke(int $id): \Illuminate\Http\JsonResponse
    {
        return fractal(
            ReceiveTimetableFromCrmAction::run($id),
            new TimetableTransformer(),
            new JsonApiSerializer($this->getUrl())
        )->withResourceName(Timetable::RESOURCE_NAME)
            ->respondJsonApi();
    }
}
