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
use Spatie\MediaLibrary\MediaCollections\Models\Media;

final class UpdateImagesTask extends \Parents\Tasks\Task
{
    /**
     * @param  User  $user
     * @param  UserData  $userData
     * @return User|Model
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     */
    public function handle(HasMedia $user, ObjectData $userData, string $collection = 'avatar'): User|Model
    {
        if (!$userData->avatar_path && !$userData->file && $userData->external_file->isNull()) {
            return $user;
        }
        /** @var ?Media $avatar */
        $avatar = $user->$collection;
        if ($avatar) {
            $avatar->delete();
        }

        $docs = $user->getMedia('documents');
        foreach ($docs as $doc) {
            $doc->delete();
        }

        if ($userData->avatar_path) {
            $user->addMedia($userData->avatar_path)
                ->toMediaCollection($collection);
        }

        if ($userData->file) {
            FindAndAttachFileAction::run($userData->file, $user, $collection);
        }

        if (!$userData->external_file->isNull()) {
            if ($userData->external_file->getKeyFromFragment()) {
                $user->addMediaFromUrl($userData->external_file->toNative())
                    ->setFileName($userData->external_file->getKeyFromFragment())
                    ->toMediaCollection($collection);
            } else {
                $user->addMediaFromUrl($userData->external_file->toNative())->toMediaCollection($collection);
            }
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
