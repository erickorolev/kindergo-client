<?php

declare(strict_types=1);

namespace Domains\Users\Actions;

use Domains\Users\DataTransferObjects\UserData;
use Domains\Users\Jobs\SendUserToVtigerJob;
use Domains\Users\Models\User;
use Support\Media\Tasks\AttachImagesTask;

/**
 * Class StoreUserAction
 * @package Domains\Users\Actions
 * @method static User run(UserData $userData, bool $dispatchUpdate = true)
 */
final class StoreUserAction extends \Parents\Actions\Action
{
    public function handle(UserData $userData, bool $dispatchUpdate = true): User
    {
        $user = User::create($userData->toArray());
        if (!empty($userData->roles)) {
            $user->syncRoles($userData->roles);
        }

        AttachImagesTask::run($user, $userData);
        if ($dispatchUpdate) {
            SendUserToVtigerJob::dispatch($user);
        }
        return $user;
    }
}
