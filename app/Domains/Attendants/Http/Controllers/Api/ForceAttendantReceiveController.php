<?php

declare(strict_types=1);

namespace Domains\Attendants\Http\Controllers\Api;

use Domains\Attendants\Actions\ReceiveAttendantFromCrmAction;
use Domains\Attendants\Models\Attendant;
use Domains\Attendants\Transformers\AttendantTransformer;
use Parents\Controllers\Controller;
use Parents\Serializers\JsonApiSerializer;

final class ForceAttendantReceiveController extends Controller
{
    public function __invoke(int $id): \Illuminate\Http\JsonResponse
    {
        return fractal(
            ReceiveAttendantFromCrmAction::run($id),
            new AttendantTransformer(),
            new JsonApiSerializer($this->getUrl())
        )->withResourceName(Attendant::RESOURCE_NAME)
            ->respondJsonApi();
    }
}
