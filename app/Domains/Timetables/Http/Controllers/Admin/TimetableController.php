<?php

declare(strict_types=1);

namespace Domains\Timetables\Http\Controllers\Admin;

use Domains\Timetables\Actions\GetAllTimetablesAdminAction;
use Domains\Timetables\Actions\GetTimetableByIdAction;
use Domains\Timetables\Actions\StoreTimetableAction;
use Domains\Timetables\Actions\UpdateTimetableAction;
use Domains\Timetables\DataTransferObjects\TimetableData;
use Domains\Timetables\Http\Requests\Admin\DeleteTimetableRequest;
use Domains\Timetables\Http\Requests\Admin\EditTimetableRequest;
use Domains\Timetables\Http\Requests\Admin\IndexTimetablesRequest;
use Domains\Timetables\Http\Requests\Admin\ShowTimetableRequest;
use Domains\Timetables\Http\Requests\Admin\TimetableStoreRequest;
use Domains\Timetables\Http\Requests\CreateTimetableRequest;
use Domains\Timetables\Http\Requests\TimetableUpdateRequest;
use Domains\Timetables\Models\Timetable;
use Domains\Users\Actions\GetUsersDropdownListAction;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Parents\Controllers\Controller;
use \Illuminate\Contracts\View\Factory;
use \Illuminate\Contracts\View\View;
use \Illuminate\Contracts\Foundation\Application;

final class TimetableController extends Controller
{
    public function index(IndexTimetablesRequest $request): Factory|View|Application
    {
        $search = $request->get('search', '');

        /** @var LengthAwarePaginator $timetables */
        $timetables = GetAllTimetablesAdminAction::run($search);

        return view('app.timetables.index', compact('timetables', 'search'));
    }

    public function create(CreateTimetableRequest $request): Factory|View|Application
    {
        /** @var Collection $users */
        $users = GetUsersDropdownListAction::run();

        return view('app.timetables.create', compact('users'));
    }

    public function store(TimetableStoreRequest $request)
    {
        /** @var Timetable $timetable */
        $timetable = StoreTimetableAction::run(TimetableData::fromRequest($request));

        return redirect()
            ->route('admin.timetables.edit', $timetable)
            ->withSuccess(__('crud.common.created'));
    }

    public function show(ShowTimetableRequest $request, int $timetable): Factory|View|Application
    {
        return view('app.timetables.show', [
            'timetable' => GetTimetableByIdAction::run($timetable)
        ]);
    }

    public function edit(EditTimetableRequest $request, int $timetable): Factory|View|Application
    {
        /** @var Collection $users */
        $users = GetUsersDropdownListAction::run();

        return view('app.timetables.edit', [
            'timetable' => GetTimetableByIdAction::run($timetable),
            'users' => $users
        ]);
    }

    public function update(
        TimetableUpdateRequest $request,
        int $timetable
    ) {
        $timetableData = TimetableData::fromRequest($request);
        $timetableData->id = $timetable;

        $timetableModel = UpdateTimetableAction::run($timetableData);

        return redirect()
            ->route('admin.timetables.edit', [
                'timetable' => $timetableModel->id
            ])
            ->withSuccess(__('crud.common.saved'));
    }

    public function destroy(DeleteTimetableRequest $request, Timetable $timetable)
    {
        $timetable->delete();

        return redirect()
            ->route('admin.timetables.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
