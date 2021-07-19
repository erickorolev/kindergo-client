<?php

declare(strict_types=1);

namespace Domains\Users\Actions;

use Domains\Users\DataTransferObjects\UserData;
use Domains\Users\Models\User;
use Domains\Users\Tasks\AttachImagesTask;

final class StoreUserAction extends \Parents\Actions\Action
{
    public function handle(UserData $userData): User
    {
        $user = User::create($userData->toArray());
        if (!empty($userData->roles)) {
            $user->syncRoles($userData->roles);
        }

        AttachImagesTask::run($user, $userData);
        return $user;
    }
}
