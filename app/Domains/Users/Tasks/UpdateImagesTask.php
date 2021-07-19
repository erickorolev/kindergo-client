<?php

declare(strict_types=1);

namespace Domains\Users\Tasks;

use Domains\TemporaryFile\Actions\FindAndAttachFileAction;
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
        if (!$userData->avatar_path && !$userData->file && $userData->external_file->isNull()) {
            return $user;
        }
        /** @var ?Media $avatar */
        $avatar = $user->avatar;
        if ($avatar) {
            $avatar->delete();
        }

        if ($userData->avatar_path) {
            $user->addMedia($userData->avatar_path)
                ->toMediaCollection('avatar');
        }

        if ($userData->file) {
            FindAndAttachFileAction::run($userData->file, $user, 'avatar');
        }

        if (!$userData->external_file->isNull()) {
            $user->addMediaFromUrl($userData->external_file->toNative())->toMediaCollection('avatar');
        }

        return $user;
    }
}
