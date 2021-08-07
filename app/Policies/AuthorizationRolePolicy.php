<?php

namespace App\Policies;

use App\AuthorizationRole;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AuthorizationRolePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.rule.list_role'));
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\AuthorizationRole  $authorizationRole
     * @return mixed
     */
    public function view(User $user, AuthorizationRole $authorizationRole)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.rule.add_role'));
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\AuthorizationRole  $authorizationRole
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.rule.edit_role'));
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\AuthorizationRole  $authorizationRole
     * @return mixed
     */
    public function delete(User $user, AuthorizationRole $authorizationRole)
    {
        return $user->checkPermissionAccess(config('permissions.rule.delete_role'));
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\AuthorizationRole  $authorizationRole
     * @return mixed
     */
    public function restore(User $user, AuthorizationRole $authorizationRole)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\AuthorizationRole  $authorizationRole
     * @return mixed
     */
    public function forceDelete(User $user, AuthorizationRole $authorizationRole)
    {
        //
    }
}
