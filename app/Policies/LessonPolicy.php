<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Lesson;
use Illuminate\Auth\Access\HandlesAuthorization;

class LessonPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the lesson can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list lessons');
    }

    /**
     * Determine whether the lesson can view the model.
     */
    public function view(User $user, Lesson $model): bool
    {
        return $user->hasPermissionTo('view lessons');
    }

    /**
     * Determine whether the lesson can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create lessons');
    }

    /**
     * Determine whether the lesson can update the model.
     */
    public function update(User $user, Lesson $model): bool
    {
        return $user->hasPermissionTo('update lessons');
    }

    /**
     * Determine whether the lesson can delete the model.
     */
    public function delete(User $user, Lesson $model): bool
    {
        return $user->hasPermissionTo('delete lessons');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete lessons');
    }

    /**
     * Determine whether the lesson can restore the model.
     */
    public function restore(User $user, Lesson $model): bool
    {
        return false;
    }

    /**
     * Determine whether the lesson can permanently delete the model.
     */
    public function forceDelete(User $user, Lesson $model): bool
    {
        return false;
    }
}
