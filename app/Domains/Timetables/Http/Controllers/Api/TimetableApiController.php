<?php

declare(strict_types=1);

namespace Domains\Timetables\Http\Controllers\Api;

use Domains\Timetables\Actions\DeleteTimetableAction;
use Domains\Timetables\Actions\GetTimetableByIdAction;
use Domains\Timetables\Actions\GetTimetablesAction;
use Domains\Timetables\Actions\StoreTimetableAction;
use Domains\Timetables\Actions\UpdateTimetableAction;
use Domains\Timetables\DataTransferObjects\TimetableData;
use Domains\Timetables\Http\Requests\Admin\DeleteTimetableRequest;
use Domains\Timetables\Http\Requests\Admin\IndexTimetablesRequest;
use Domains\Timetables\Http\Requests\Admin\ShowTimetableRequest;
use Domains\Timetables\Http\Requests\Api\StoreTimetableApiRequest;
use Domains\Timetables\Http\Requests\Api\UpdateTimetableApiRequest;
use Domains\Timetables\Models\Timetable;
use Domains\Timetables\Transformers\TimetableTransformer;
use Parents\Controllers\Controller;
use Parents\Serializers\JsonApiSerializer;
use Parents\Traits\RelationTrait;
use Symfony\Component\HttpFoundation\Response;

final class TimetableApiController extends Controller
{
    use RelationTrait;

    protected string $relationClass = GetTimetableByIdAction::class;

    public function index(IndexTimetablesRequest $request): \Illuminate\Http\JsonResponse
    {
        /** @var Timetable[] $timetables */
        $timetables = GetTimetablesAction::run();

        return fractal(
            $timetables,
            new TimetableTransformer(),
            new JsonApiSerializer($this->getUrl())
        )->withResourceName(Timetable::RESOURCE_NAME)
            ->respondJsonApi();
    }

    public function store(StoreTimetableApiRequest $request): \Illuminate\Http\JsonResponse
    {
        /** @var Timetable $timetable */
        $timetable = StoreTimetableAction::run(TimetableData::fromRequest($request, 'data.attributes.'));

        return fractal(
            $timetable,
            new TimetableTransformer(),
            new JsonApiSerializer($this->getUrl())
        )->withResourceName(Timetable::RESOURCE_NAME)
            ->respondJsonApi(Response::HTTP_CREATED, [
                'Location' => route('api.timetables.show', [
                    'timetable' => $timetable->id
                ])
            ]);
    }

    public function show(ShowTimetableRequest $request, int $timetable): \Illuminate\Http\JsonResponse
    {
        return fractal(
            GetTimetableByIdAction::run($timetable),
            new TimetableTransformer(),
            new JsonApiSerializer($this->getUrl())
        )->withResourceName(Timetable::RESOURCE_NAME)
            ->respondJsonApi();
    }

    public function update(
        UpdateTimetableApiRequest $request,
        int $timetable
    ): \Illuminate\Http\JsonResponse {
        $timetableData = TimetableData::fromRequest($request, 'data.attributes.');
        $timetableData->id = $timetable;

        return fractal(
            UpdateTimetableAction::run($timetableData),
            new TimetableTransformer(),
            new JsonApiSerializer($this->getUrl())
        )->withResourceName(Timetable::RESOURCE_NAME)
            ->respondJsonApi(Response::HTTP_ACCEPTED);
    }

    public function destroy(DeleteTimetableRequest $request, int $timetable): \Illuminate\Http\Response
    {
        DeleteTimetableAction::run($timetable);

        return response()->noContent();
    }
}
