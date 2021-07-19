<?php

declare(strict_types=1);

namespace Domains\Children\Actions;

use Domains\Children\DataTransferObjects\ChildData;
use Domains\Children\Models\Child;
use Domains\Users\Actions\GetUserIdsFromArrayAction;
use Support\Media\Tasks\UpdateImagesTask;

final class UpdateChildAction extends \Parents\Actions\Action
{
    public function handle(ChildData $childData): Child
    {
        /** @var Child $child */
        $child = GetChildByIdAction::run($childData->id);
        $child->update($childData->toArray());
        if ($childData->users) {
            $child->users()->sync(GetUserIdsFromArrayAction::run($childData->users));
        }
        UpdateImagesTask::run($child, $childData);
        return $child;
    }
}
