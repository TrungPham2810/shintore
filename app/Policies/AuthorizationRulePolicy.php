<?php

namespace App\Policies;

use App\AuthorizationRule;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AuthorizationRulePolicy
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
        return $user->checkPermissionAccess(config('permissions.rule.list_rule'));
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\AuthorizationRule  $authorizationRule
     * @return mixed
     */
    public function view(User $user, AuthorizationRule $authorizationRule)
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
        return $user->checkPermissionAccess(config('permissions.rule.add_rule'));
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\AuthorizationRule  $authorizationRule
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.rule.edit_rule'));
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\AuthorizationRule  $authorizationRule
     * @return mixed
     */
    public function delete(User $user, AuthorizationRule $authorizationRule)
    {
        return $user->checkPermissionAccess(config('permissions.rule.delete_rule'));
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\AuthorizationRule  $authorizationRule
     * @return mixed
     */
    public function restore(User $user, AuthorizationRule $authorizationRule)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\AuthorizationRule  $authorizationRule
     * @return mixed
     */
    public function forceDelete(User $user, AuthorizationRule $authorizationRule)
    {
        //
    }
}
