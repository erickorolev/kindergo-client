<?php

declare(strict_types=1);

namespace Domains\Users\Actions;

use Domains\Users\DataTransferObjects\UserData;
use Domains\Users\Models\User;
use Domains\Users\Tasks\UpdateImagesTask;

final class UpdateUserAction extends \Parents\Actions\Action
{
    public function handle(UserData $userData): User
    {
        /** @var User $user */
        $user = GetUserByIdAction::run($userData->id);
        $user->update($userData->toArray());
        $user->syncRoles($userData->roles);
        UpdateImagesTask::run($user, $userData);
        return $user;
    }
}
