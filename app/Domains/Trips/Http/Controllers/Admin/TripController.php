<?php

declare(strict_types=1);

namespace Domains\Trips\Http\Controllers\Admin;

use Domains\Attendants\Actions\GetAttendantPicklistAction;
use Domains\Children\Actions\GetChildrenDropdownListAction;
use Domains\Timetables\Actions\TimetablesPicklistAction;
use Domains\Trips\Actions\DeleteTripAction;
use Domains\Trips\Actions\GetAllTripsAdminAction;
use Domains\Trips\Actions\GetTripByIdAction;
use Domains\Trips\Actions\StoreTripAction;
use Domains\Trips\Actions\UpdateTripAction;
use Domains\Trips\DataTransferObjects\TripData;
use Domains\Trips\Http\Requests\Admin\CreateTimetableRequest;
use Domains\Trips\Http\Requests\Admin\EditTripRequest;
use Domains\Trips\Http\Requests\Admin\IndexTripsRequest;
use Domains\Trips\Http\Requests\Admin\ShowTripRequest;
use Domains\Trips\Http\Requests\Admin\TripStoreRequest;
use Domains\Trips\Http\Requests\Admin\DeleteTripRequest;
use Domains\Trips\Http\Requests\Admin\TripUpdateRequest;
use Domains\Trips\Models\Trip;
use Domains\Users\Actions\GetUsersDropdownListAction;
use Illuminate\Support\Collection;
use Parents\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Foundation\Application;

final class TripController extends Controller
{
    public function index(IndexTripsRequest $request): Factory|View|Application
    {
        $search = $request->get('search', '');

        if (!$search) {
            $search = '';
        }
        /** @var Collection $trips */
        $trips = GetAllTripsAdminAction::run($search);

        return view('app.trips.index', compact('trips', 'search'));
    }

    public function create(CreateTimetableRequest $request): Factory|View|Application
    {
        /** @var Collection $attendants */
        $attendants = GetAttendantPicklistAction::run();
        /** @var Collection $timetables */
        $timetables = TimetablesPicklistAction::run();
        /** @var Collection $users */
        $users = GetUsersDropdownListAction::run();
        /** @var Collection $children */
        $children = GetChildrenDropdownListAction::run();

        return view('app.trips.create', compact(
            'attendants',
            'timetables',
            'users',
            'children'
        ));
    }

    public function store(TripStoreRequest $request)
    {
        /** @var Trip $trip */
        $trip = StoreTripAction::run(TripData::fromRequest($request));

        return redirect()
            ->route('admin.trips.edit', $trip->id)
            ->withSuccess(__('crud.common.created'));
    }

    public function show(ShowTripRequest $request, int $trip): Factory|View|Application
    {
        /** @var Trip $trip */
        $trip = GetTripByIdAction::run($trip);

        return view('app.trips.show', compact('trip'));
    }

    public function edit(EditTripRequest $request, Trip $trip): Factory|View|Application
    {
        /** @var Collection $attendants */
        $attendants = GetAttendantPicklistAction::run();
        /** @var Collection $timetables */
        $timetables = TimetablesPicklistAction::run();
        /** @var Collection $users */
        $users = GetUsersDropdownListAction::run();
        /** @var Collection $children */
        $children = GetChildrenDropdownListAction::run();
        $selected_children = $trip->children->pluck('id')->toArray();

        return view(
            'app.trips.edit',
            compact(
                'trip',
                'attendants',
                'timetables',
                'users',
                'children',
                'selected_children'
            )
        );
    }

    public function update(TripUpdateRequest $request, int $trip)
    {
        $tripData = TripData::fromRequest($request);
        $tripData->id = $trip;
        $tripModel = UpdateTripAction::run($tripData);

        return redirect()
            ->route('admin.trips.edit', $tripModel->id)
            ->withSuccess(__('crud.common.saved'));
    }

    public function destroy(DeleteTripRequest $request, int $trip)
    {
        DeleteTripAction::run($trip);

        return redirect()
            ->route('admin.trips.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
