<?php

declare(strict_types=1);

namespace Domains\Attendants\Http\Controllers\Api;

use Domains\Attendants\Actions\DeleteAttendantAction;
use Domains\Attendants\Actions\GetAllAttendantAction;
use Domains\Attendants\Actions\GetAttendantByIdAction;
use Domains\Attendants\Actions\StoreAttendantAction;
use Domains\Attendants\Actions\UpdateAttendantAction;
use Domains\Attendants\DataTransferObjects\AttendantData;
use Domains\Attendants\Http\Requests\Admin\DeleteAttendantRequest;
use Domains\Attendants\Http\Requests\Admin\IndexAttendantRequest;
use Domains\Attendants\Http\Requests\Admin\ShowAttendantRequest;
use Domains\Attendants\Http\Requests\Api\AttendantStoreApiRequest;
use Domains\Attendants\Http\Requests\Api\AttendantUpdateApiRequest;
use Domains\Attendants\Models\Attendant;
use Domains\Attendants\Transformers\AttendantTransformer;
use Illuminate\Pagination\LengthAwarePaginator;
use Parents\Controllers\Controller;
use Parents\Serializers\JsonApiSerializer;
use Parents\Traits\RelationTrait;
use Symfony\Component\HttpFoundation\Response;

final class AttendantApiController extends Controller
{
    use RelationTrait;

    protected string $relationClass = GetAttendantByIdAction::class;

    public function index(IndexAttendantRequest $request): \Illuminate\Http\JsonResponse
    {
        /** @var LengthAwarePaginator $attendants */
        $attendants = GetAllAttendantAction::run();

        return fractal(
            $attendants,
            new AttendantTransformer(),
            new JsonApiSerializer($this->getUrl())
        )->withResourceName(Attendant::RESOURCE_NAME)
            ->respondJsonApi();
    }

    public function store(AttendantStoreApiRequest $request): \Illuminate\Http\JsonResponse
    {
        $attendant = StoreAttendantAction::run(
            AttendantData::fromRequest($request, 'data.attributes.')
        );

        return fractal(
            $attendant,
            new AttendantTransformer(),
            new JsonApiSerializer($this->getUrl())
        )->withResourceName(Attendant::RESOURCE_NAME)
            ->respondJsonApi(Response::HTTP_CREATED, [
                'Location' => route('api.attendants.show', [
                    'attendant' => $attendant->id
                ])
            ]);
    }

    public function show(ShowAttendantRequest $request, int $attendant): \Illuminate\Http\JsonResponse
    {
        /** @var Attendant $attendantModel */
        $attendantModel = GetAttendantByIdAction::run($attendant);

        return fractal(
            $attendantModel,
            new AttendantTransformer(),
            new JsonApiSerializer($this->getUrl())
        )->withResourceName(Attendant::RESOURCE_NAME)
            ->respondJsonApi();
    }

    public function update(
        AttendantUpdateApiRequest $request,
        int $attendant
    ): \Illuminate\Http\JsonResponse {
        $attendantData = AttendantData::fromRequest($request, 'data.attributes.');
        $attendantData->id = $attendant;

        return fractal(
            UpdateAttendantAction::run($attendantData),
            new AttendantTransformer(),
            new JsonApiSerializer($this->getUrl())
        )->withResourceName(Attendant::RESOURCE_NAME)
            ->respondJsonApi(Response::HTTP_ACCEPTED);
    }

    public function destroy(DeleteAttendantRequest $request, int $attendant): \Illuminate\Http\Response
    {
        DeleteAttendantAction::run($attendant);

        return response()->noContent();
    }
}
