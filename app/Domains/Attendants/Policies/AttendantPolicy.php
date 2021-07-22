<?php

declare(strict_types=1);

namespace Domains\Attendants\Policies;

use Domains\Attendants\Models\Attendant;
use Domains\Users\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AttendantPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list attendants');
    }

    public function view(User $user, Attendant $model): bool
    {
        return $user->hasPermissionTo('view attendants');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create attendants');
    }

    public function update(User $user, Attendant $model): bool
    {
        return $user->hasPermissionTo('update attendants');
    }

    public function delete(User $user, Attendant $model): bool
    {
        return $user->hasPermissionTo('delete attendants');
    }

    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete attendants');
    }

    public function restore(User $user, Attendant $model): bool
    {
        return false;
    }

    public function forceDelete(User $user, Attendant $model): bool
    {
        return false;
    }
}
