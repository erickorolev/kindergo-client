<?php

declare(strict_types=1);

namespace Domains\Users\Actions;

use Domains\Users\Models\User;

final class GetUserByIdAction extends \Parents\Actions\Action
{
    public function handle(int $id): User
    {
        return User::whereId($id)->firstOrFail();
    }
}
