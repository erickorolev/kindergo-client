<?php

declare(strict_types=1);

namespace Domains\Users\Tasks;

use Domains\TemporaryFile\Actions\FindAndAttachFileAction;
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
        if ($userData->file) {
            FindAndAttachFileAction::run($userData->file, $user, 'avatar');
        }
        if (!$userData->external_file->isNull()) {
            $user->addMediaFromUrl($userData->external_file->toNative())->toMediaCollection('avatar');
        }
        return $user;
    }
}
