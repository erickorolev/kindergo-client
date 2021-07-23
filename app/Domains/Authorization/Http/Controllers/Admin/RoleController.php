<?php

declare(strict_types=1);

namespace Domains\Authorization\Http\Controllers\Admin;

use Domains\Authorization\Actions\DeleteRoleByIdAction;
use Domains\Authorization\Actions\GetAllPermissionsAction;
use Domains\Authorization\Actions\GetAllRolesAdminAction;
use Domains\Authorization\Actions\GetRoleByIdAction;
use Domains\Authorization\Actions\StoreRoleAction;
use Domains\Authorization\Actions\UpdateRoleAction;
use Domains\Authorization\DataTransferObjects\RoleData;
use Domains\Authorization\Http\Requests\Admin\DeleteRoleRequest;
use Domains\Authorization\Http\Requests\Admin\IndexRoleRequest;
use Domains\Authorization\Http\Requests\Admin\CreateRoleRequest;
use Domains\Authorization\Http\Requests\Admin\ShowRoleRequest;
use Domains\Authorization\Http\Requests\Admin\StoreRoleRequest;
use Domains\Authorization\Http\Requests\Admin\EditRoleRequest;
use Domains\Authorization\Http\Requests\Admin\UpdateRoleRequest;
use Domains\Authorization\Models\Permission;
use Domains\Authorization\Models\Role;
use Illuminate\Pagination\LengthAwarePaginator;
use Parents\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Foundation\Application;

final class RoleController extends Controller
{

    public function index(IndexRoleRequest $request): Factory|View|Application
    {
        $search = $request->get('search', '');
        if (!$search) {
            $search = '';
        }
        /** @var LengthAwarePaginator $roles */
        $roles = GetAllRolesAdminAction::run($search);

        return view('app.roles.index')
            ->with('roles', $roles)
            ->with('search', $search);
    }

    public function create(CreateRoleRequest $request): Factory|View|Application
    {
        /** @var Permission[] $permissions */
        $permissions = GetAllPermissionsAction::run();

        return view('app.roles.create')->with('permissions', $permissions);
    }

    public function store(StoreRoleRequest $request)
    {
        /** @var Role $role */
        $role = StoreRoleAction::run(RoleData::fromRequest($request));

        return redirect()
            ->route('admin.roles.edit', $role->id)
            ->withSuccess(__('crud.common.created'));
    }

    public function show(ShowRoleRequest $request, int $role): Factory|View|Application
    {
        $roleModel = GetRoleByIdAction::run($role);

        return view('app.roles.show')->with('role', $roleModel);
    }

    public function edit(EditRoleRequest $request, int $role): Factory|View|Application
    {
        /** @var Permission[] $permissions */
        $permissions = GetAllPermissionsAction::run();
        /** @var Role $roleModel */
        $roleModel = GetRoleByIdAction::run($role);

        return view('app.roles.edit')
            ->with('role', $roleModel)
            ->with('permissions', $permissions);
    }

    public function update(UpdateRoleRequest $request, int $role)
    {
        $roleData = RoleData::fromRequest($request);
        $roleData->id = $role;

        $roleModel = UpdateRoleAction::run($roleData);

        return redirect()
            ->route('admin.roles.edit', $roleModel->id)
            ->withSuccess(__('crud.common.saved'));
    }

    public function destroy(DeleteRoleRequest $request, int $role)
    {
        DeleteRoleByIdAction::run($role);

        return redirect()
            ->route('admin.roles.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
