<?php

declare(strict_types=1);

namespace Domains\Users\Actions;

use Domains\Users\Models\User;

final class GetUserByEmailAction extends \Parents\Actions\Action
{
    public function handle(string $email): ?User
    {
        return User::whereEmail($email)->first();
    }
}
