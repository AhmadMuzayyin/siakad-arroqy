<?php

namespace App\Policies;

use App\Models\User;
use App\Models\HomeroomTeacher;
use Illuminate\Auth\Access\HandlesAuthorization;

class HomeroomTeacherPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the homeroomTeacher can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list homeroomteachers');
    }

    /**
     * Determine whether the homeroomTeacher can view the model.
     */
    public function view(User $user, HomeroomTeacher $model): bool
    {
        return $user->hasPermissionTo('view homeroomteachers');
    }

    /**
     * Determine whether the homeroomTeacher can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create homeroomteachers');
    }

    /**
     * Determine whether the homeroomTeacher can update the model.
     */
    public function update(User $user, HomeroomTeacher $model): bool
    {
        return $user->hasPermissionTo('update homeroomteachers');
    }

    /**
     * Determine whether the homeroomTeacher can delete the model.
     */
    public function delete(User $user, HomeroomTeacher $model): bool
    {
        return $user->hasPermissionTo('delete homeroomteachers');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete homeroomteachers');
    }

    /**
     * Determine whether the homeroomTeacher can restore the model.
     */
    public function restore(User $user, HomeroomTeacher $model): bool
    {
        return false;
    }

    /**
     * Determine whether the homeroomTeacher can permanently delete the model.
     */
    public function forceDelete(User $user, HomeroomTeacher $model): bool
    {
        return false;
    }
}
