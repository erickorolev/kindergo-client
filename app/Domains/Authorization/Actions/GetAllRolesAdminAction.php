<?php

declare(strict_types=1);

namespace Domains\Authorization\Actions;

use Domains\Authorization\Models\Role;
use \Illuminate\Pagination\LengthAwarePaginator;

final class GetAllRolesAdminAction extends \Parents\Actions\Action
{
    public function handle(string $search = '', int $pagination = 10): LengthAwarePaginator
    {
        return Role::where('name', 'like', "%{$search}%")->paginate($pagination);
    }
}
