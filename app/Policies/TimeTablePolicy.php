<?php

namespace App\Policies;

use App\Models\User;
use App\Models\TimeTable;
use Illuminate\Auth\Access\HandlesAuthorization;

class TimeTablePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the timeTable can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list timetables');
    }

    /**
     * Determine whether the timeTable can view the model.
     */
    public function view(User $user, TimeTable $model): bool
    {
        return $user->hasPermissionTo('view timetables');
    }

    /**
     * Determine whether the timeTable can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create timetables');
    }

    /**
     * Determine whether the timeTable can update the model.
     */
    public function update(User $user, TimeTable $model): bool
    {
        return $user->hasPermissionTo('update timetables');
    }

    /**
     * Determine whether the timeTable can delete the model.
     */
    public function delete(User $user, TimeTable $model): bool
    {
        return $user->hasPermissionTo('delete timetables');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete timetables');
    }

    /**
     * Determine whether the timeTable can restore the model.
     */
    public function restore(User $user, TimeTable $model): bool
    {
        return false;
    }

    /**
     * Determine whether the timeTable can permanently delete the model.
     */
    public function forceDelete(User $user, TimeTable $model): bool
    {
        return false;
    }
}
