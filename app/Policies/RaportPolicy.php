<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Raport;
use Illuminate\Auth\Access\HandlesAuthorization;

class RaportPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the raport can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list raports');
    }

    /**
     * Determine whether the raport can view the model.
     */
    public function view(User $user, Raport $model): bool
    {
        return $user->hasPermissionTo('view raports');
    }

    /**
     * Determine whether the raport can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create raports');
    }

    /**
     * Determine whether the raport can update the model.
     */
    public function update(User $user, Raport $model): bool
    {
        return $user->hasPermissionTo('update raports');
    }

    /**
     * Determine whether the raport can delete the model.
     */
    public function delete(User $user, Raport $model): bool
    {
        return $user->hasPermissionTo('delete raports');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete raports');
    }

    /**
     * Determine whether the raport can restore the model.
     */
    public function restore(User $user, Raport $model): bool
    {
        return false;
    }

    /**
     * Determine whether the raport can permanently delete the model.
     */
    public function forceDelete(User $user, Raport $model): bool
    {
        return false;
    }
}
