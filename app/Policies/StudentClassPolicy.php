<?php

namespace App\Policies;

use App\Models\User;
use App\Models\StudentClass;
use Illuminate\Auth\Access\HandlesAuthorization;

class StudentClassPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the studentClass can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list studentclasses');
    }

    /**
     * Determine whether the studentClass can view the model.
     */
    public function view(User $user, StudentClass $model): bool
    {
        return $user->hasPermissionTo('view studentclasses');
    }

    /**
     * Determine whether the studentClass can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create studentclasses');
    }

    /**
     * Determine whether the studentClass can update the model.
     */
    public function update(User $user, StudentClass $model): bool
    {
        return $user->hasPermissionTo('update studentclasses');
    }

    /**
     * Determine whether the studentClass can delete the model.
     */
    public function delete(User $user, StudentClass $model): bool
    {
        return $user->hasPermissionTo('delete studentclasses');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete studentclasses');
    }

    /**
     * Determine whether the studentClass can restore the model.
     */
    public function restore(User $user, StudentClass $model): bool
    {
        return false;
    }

    /**
     * Determine whether the studentClass can permanently delete the model.
     */
    public function forceDelete(User $user, StudentClass $model): bool
    {
        return false;
    }
}
