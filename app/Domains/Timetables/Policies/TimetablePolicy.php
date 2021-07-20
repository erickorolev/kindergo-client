<?php

declare(strict_types=1);

namespace Domains\Timetables\Policies;

use Domains\Timetables\Models\Timetable;
use Domains\Users\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

final class TimetablePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list timetables');
    }

    public function view(User $user, Timetable $model): bool
    {
        return $user->hasPermissionTo('view timetables');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create timetables');
    }

    public function update(User $user, Timetable $model): bool
    {
        return $user->hasPermissionTo('update timetables');
    }

    public function delete(User $user, Timetable $model): bool
    {
        return $user->hasPermissionTo('delete timetables');
    }

    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete timetables');
    }

    public function restore(User $user, Timetable $model): bool
    {
        return false;
    }

    public function forceDelete(User $user, Timetable $model): bool
    {
        return false;
    }
}
