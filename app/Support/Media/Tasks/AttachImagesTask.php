<?php

declare(strict_types=1);

namespace Support\Media\Tasks;

use Domains\TemporaryFile\Actions\FindAndAttachFileAction;
use Domains\Users\DataTransferObjects\UserData;
use Domains\Users\Models\User;
use Parents\DataTransferObjects\ObjectData;
use Parents\Models\Model;
use Parents\ValueObjects\UrlValueObject;
use Spatie\MediaLibrary\HasMedia;

final class AttachImagesTask extends \Parents\Tasks\Task
{
    /**
     * @param  User  $user
     * @param  UserData  $userData
     * @param  string  $collection
     * @return User|Model
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     */
    public function handle(HasMedia $user, ObjectData $userData, string $collection = 'avatar'): User|Model
    {
        if ($userData->avatar_path) {
            $user->addMedia($userData->avatar_path)
                ->toMediaCollection($collection);
        }
        if ($userData->file) {
            FindAndAttachFileAction::run($userData->file, $user, $collection);
        }
        if (!$userData->external_file->isNull()) {
            $user->addMediaFromUrl($userData->external_file->toNative())->toMediaCollection($collection);
        }
        if (!empty($userData->documents)) {
            /** @var UrlValueObject $document */
            foreach ($userData->documents as $document) {
                $user->addMediaFromUrl($document->toNative())->toMediaCollection('documents');
            }
        }
        return $user;
    }
}
