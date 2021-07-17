<?php

declare(strict_types=1);

namespace Domains\Authorization\Actions;

use Domains\Authorization\Models\Permission;

final class GetAllPermissionsAdminAction extends \Parents\Actions\Action
{
    public function handle(
        string $search = '',
        int $pagination = 10
    ): \Illuminate\Pagination\LengthAwarePaginator
    {
        return Permission::where('name', 'like', "%{$search}%")->paginate($pagination);
    }
}
