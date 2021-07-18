<?php

declare(strict_types=1);

namespace Domains\Users\Actions;

use Domains\Users\Models\User;

final class GetUserByCrmidAction extends \Parents\Actions\Action
{
    public function handle(string $crmid): ?User
    {
        return User::where('crmid', $crmid)->first();
    }
}
