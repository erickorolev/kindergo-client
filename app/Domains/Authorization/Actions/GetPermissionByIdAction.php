<?php

declare(strict_types=1);

namespace Domains\Authorization\Actions;

use Domains\Authorization\Models\Permission;

final class GetPermissionByIdAction extends \Parents\Actions\Action
{
    public function handle(int $id): \Spatie\Permission\Models\Permission
    {
        return Permission::whereId($id)->firstOrFail();
    }
}
