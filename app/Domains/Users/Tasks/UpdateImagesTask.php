<?php

declare(strict_types=1);

namespace Domains\Users\Tasks;

use Domains\Users\DataTransferObjects\UserData;
use Domains\Users\Models\User;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

final class UpdateImagesTask extends \Parents\Tasks\Task
{
    /**
     * @param  User  $user
     * @param  UserData  $userData
     * @return User
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     */
    public function handle(User $user, UserData $userData): User
    {
        /** @var ?Media $avatar */
        $avatar = $user->avatar;
        if ($userData->avatar_path) {
            if (!$avatar || $userData->avatar_path !== $avatar->file_name) {
                if ($avatar) {
                    $avatar->delete();
                }

                $user->addMedia($userData->avatar_path)
                    ->toMediaCollection('avatar');
            }
        } elseif ($avatar) {
            $avatar->delete();
        }
        return $user;
    }
}
