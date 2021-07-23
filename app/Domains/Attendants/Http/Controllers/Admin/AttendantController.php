<?php

declare(strict_types=1);

namespace Domains\Attendants\Http\Controllers\Admin;

use Domains\Attendants\Actions\DeleteAttendantAction;
use Domains\Attendants\Actions\GetAttendantByIdAction;
use Domains\Attendants\Actions\GetAttendantsAdminAction;
use Domains\Attendants\Actions\StoreAttendantAction;
use Domains\Attendants\Actions\UpdateAttendantAction;
use Domains\Attendants\DataTransferObjects\AttendantData;
use Domains\Attendants\Http\Requests\Admin\AttendantStoreRequest;
use Domains\Attendants\Http\Requests\Admin\AttendantUpdateRequest;
use Domains\Attendants\Http\Requests\Admin\CreateAttendantRequest;
use Domains\Attendants\Http\Requests\Admin\DeleteAttendantRequest;
use Domains\Attendants\Http\Requests\Admin\EditAttendantRequest;
use Domains\Attendants\Http\Requests\Admin\IndexAttendantRequest;
use Domains\Attendants\Http\Requests\Admin\ShowAttendantRequest;
use Domains\Attendants\Models\Attendant;
use Illuminate\Pagination\LengthAwarePaginator;
use Parents\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Foundation\Application;

final class AttendantController extends Controller
{
    public function index(IndexAttendantRequest $request): \Illuminate\View\View|View|Application
    {
        /** @var ?string $search */
        $search = $request->get('search', '');

        if (!$search) {
            $search = '';
        }

        /** @var LengthAwarePaginator $attendants */
        $attendants = GetAttendantsAdminAction::run($search);

        return view('app.attendants.index', compact('attendants', 'search'));
    }

    public function create(CreateAttendantRequest $request): \Illuminate\View\View|View|Application
    {
        return view('app.attendants.create');
    }

    public function store(
        AttendantStoreRequest $request
    ): \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse {
        /** @var Attendant $attendant */
        $attendant = StoreAttendantAction::run(AttendantData::fromRequest($request));

        return redirect()
            ->route('admin.attendants.edit', $attendant->id)
            ->withSuccess(__('crud.common.created'));
    }

    public function show(ShowAttendantRequest $request, int $attendant): \Illuminate\View\View|View|Application
    {
        /** @var Attendant $attendantModel */
        $attendantModel = GetAttendantByIdAction::run($attendant);

        return view('app.attendants.show', [
            'attendant' => $attendantModel
        ]);
    }

    public function edit(EditAttendantRequest $request, int $attendant): \Illuminate\View\View|View|Application
    {
        /** @var Attendant $attendantModel */
        $attendantModel = GetAttendantByIdAction::run($attendant);

        return view('app.attendants.edit', [
            'attendant' => $attendantModel
        ]);
    }

    public function update(
        AttendantUpdateRequest $request,
        int $attendant
    ): \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse {
        $attendantData = AttendantData::fromRequest($request);
        $attendantData->id = $attendant;

        $attendant = UpdateAttendantAction::run($attendantData);

        return redirect()
            ->route('admin.attendants.edit', $attendant)
            ->withSuccess(__('crud.common.saved'));
    }

    public function destroy(
        DeleteAttendantRequest $request,
        int $attendant
    ): \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse {
        DeleteAttendantAction::run($attendant);

        return redirect()
            ->route('admin.attendants.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
