<?php

declare(strict_types=1);

namespace Domains\Users\Actions\Admin;

use Domains\Users\Models\User;

final class IndexUserAction extends \Parents\Actions\Action
{
    public function handle(string $search, int $pagination = 5): \Illuminate\Pagination\LengthAwarePaginator
    {
        return User::search($search)
            ->latest()
            ->paginate($pagination);
    }
}
