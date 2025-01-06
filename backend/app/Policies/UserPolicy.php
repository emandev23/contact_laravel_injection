<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the user can create a new user.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        $role = $user->roles()->first();
        return $user->hasRole($role); // Only admins can create users
    }

    /**
     * Determine if the user can update the given user.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function update(User $user, User $model)
    {
        return $user->hasRole('admin') || $user->id === $model->id; // Admins can update any user, others can update their own profile
    }

    /**
     * Determine if the user can delete the given user.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function delete(User $user, User $model)
    {
        return $user->hasRole('admin') && $user->id !== $model->id; // Admins can delete users, but not themselves
    }
}
