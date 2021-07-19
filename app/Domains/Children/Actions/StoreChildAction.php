<?php

declare(strict_types=1);

namespace Domains\Children\Actions;

use Domains\Children\DataTransferObjects\ChildData;
use Domains\Children\Models\Child;
use Domains\Users\Actions\GetUserIdsFromArrayAction;
use Support\Media\Tasks\AttachImagesTask;

final class StoreChildAction extends \Parents\Actions\Action
{
    public function handle(ChildData $data): Child
    {
        $child = Child::create($data->toArray());
        if ($data->users) {
            $child->users()->attach(GetUserIdsFromArrayAction::run($data->users));
        }
        AttachImagesTask::run($child, $data);
        return $child;
    }
}
