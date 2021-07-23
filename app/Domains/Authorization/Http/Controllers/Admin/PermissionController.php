<?php

declare(strict_types=1);

namespace Domains\Authorization\Http\Controllers\Admin;

use Domains\Authorization\Actions\DeletePermissionAction;
use Domains\Authorization\Actions\GetAllPermissionsAdminAction;
use Domains\Authorization\Actions\GetAllRolesAction;
use Domains\Authorization\Actions\GetPermissionByIdAction;
use Domains\Authorization\Actions\StorePermissionAction;
use Domains\Authorization\Actions\UpdatePermissionAction;
use Domains\Authorization\DataTransferObjects\PermissionData;
use Domains\Authorization\Http\Requests\Admin\IndexPermissionsRequest;
use Domains\Authorization\Http\Requests\Admin\CreatePermissionRequest;
use Domains\Authorization\Http\Requests\Admin\DeletePermissionRequest;
use Domains\Authorization\Http\Requests\Admin\EditPermissionRequest;
use Domains\Authorization\Http\Requests\Admin\ShowPermissionRequest;
use Domains\Authorization\Http\Requests\Admin\StorePermissionRequest;
use Domains\Authorization\Http\Requests\Admin\UpdatePermissionRequest;
use Domains\Authorization\Models\Permission;
use Domains\Authorization\Models\Role;
use Illuminate\Pagination\LengthAwarePaginator;
use Parents\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Foundation\Application;

final class PermissionController extends Controller
{
    public function index(IndexPermissionsRequest $request): Factory|View|Application
    {
        /** @var ?string $search */
        $search = $request->get('search', '');
        if (!$search) {
            $search = '';
        }
        /** @var LengthAwarePaginator $permissions */
        $permissions = GetAllPermissionsAdminAction::run($search);

        return view('app.permissions.index')
            ->with('permissions', $permissions)
            ->with('search', $search);
    }

    public function create(CreatePermissionRequest $request): Factory|View|Application
    {
        $roles = GetAllRolesAction::run();
        return view('app.permissions.create')->with('roles', $roles);
    }

    public function store(StorePermissionRequest $request)
    {
        $permission = StorePermissionAction::run(PermissionData::fromRequest($request));

        return redirect()
            ->route('admin.permissions.edit', $permission->id)
            ->withSuccess(__('crud.common.created'));
    }

    public function show(ShowPermissionRequest $request, int $permission): Factory|View|Application
    {
        /** @var Permission $permissionModel */
        $permissionModel = GetPermissionByIdAction::run($permission);

        return view('app.permissions.show')->with('permission', $permissionModel);
    }

    public function edit(EditPermissionRequest $request, int $permission): Factory|View|Application
    {
        /** @var Permission $permissionModel */
        $permissionModel = GetPermissionByIdAction::run($permission);
        /** @var Role[] $roles */
        $roles = GetAllRolesAction::run();

        return view('app.permissions.edit')
            ->with('permission', $permissionModel)
            ->with('roles', $roles);
    }

    public function update(UpdatePermissionRequest $request, int $permission)
    {
        $permissionData = PermissionData::fromRequest($request);
        $permissionData->id = $permission;
        /** @var Permission $permissionModel */
        $permissionModel = UpdatePermissionAction::run($permissionData);

        return redirect()
            ->route('admin.permissions.edit', $permissionModel)
            ->withSuccess(__('crud.common.saved'));
    }

    public function destroy(DeletePermissionRequest $request, int $permission)
    {
        DeletePermissionAction::run($permission);

        return redirect()
            ->route('admin.permissions.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
