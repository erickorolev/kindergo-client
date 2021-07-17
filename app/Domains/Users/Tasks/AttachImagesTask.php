<?php

declare(strict_types=1);

namespace Domains\Users\Tasks;

use Domains\Users\DataTransferObjects\UserData;
use Domains\Users\Models\User;

final class AttachImagesTask extends \Parents\Tasks\Task
{
    public function handle(User $user, UserData $userData): User
    {
        if ($userData->avatar_path) {
            $user->addMedia($userData->avatar_path)
                ->toMediaCollection('avatar');
        }
        return $user;
    }
}
