<?php

declare(strict_types=1);

namespace Domains\Attendants\Actions;

use Domains\Attendants\Models\Attendant;
use Domains\Attendants\Repositories\AttendantRepositoryInterface;

final class GetAttendantByIdAction extends \Parents\Actions\Action
{
    public function __construct(
        protected AttendantRepositoryInterface $repository
    ) {
    }

    public function handle(int $id): Attendant
    {
        /** @var Attendant $attendant */
        $attendant = $this->repository->findJson($id);
        return $attendant;
    }
}
