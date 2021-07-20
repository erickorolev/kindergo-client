<?php

declare(strict_types=1);

namespace Domains\Users\Actions;

use Domains\Users\Models\User;

final class GetClearUserIdAction extends \Parents\Actions\Action
{
    public function handle(string|int|null $id): ?int
    {
        if ($id === null) {
            return null;
        }
        /** @var ?User $user */
        $user = GetUserByCrmidAction::run($id);
        if ($user) {
            return $user->id;
        }
        $user = GetUserByIdAction::run($id);
        return $user->id;
    }
}
