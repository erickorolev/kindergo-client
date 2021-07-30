<?php

declare(strict_types=1);

namespace Domains\Users\Actions;

use Domains\Users\DataTransferObjects\UserData;
use Domains\Users\Jobs\SendUserToVtigerJob;
use Domains\Users\Models\User;
use Support\Media\Tasks\UpdateImagesTask;

final class UpdateUserAction extends \Parents\Actions\Action
{
    public function handle(UserData $userData, bool $dispatchUpdate = true): User
    {
        /** @var User $user */
        $user = GetUserByIdAction::run($userData->id);
        $user->update($userData->toArray());
        $user->syncRoles($userData->roles);
        UpdateImagesTask::run($user, $userData);
        if ($dispatchUpdate) {
            SendUserToVtigerJob::dispatch($user);
        }
        return $user;
    }
}
