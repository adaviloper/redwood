<?php

namespace App\Policies;

use App\Models\Scenario;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ScenarioPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view-any-scenario');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Scenario $scenario): bool
    {
        return $user->hasPermissionTo('view-scenario');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create-scenarios');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Scenario $scenario): bool
    {
        return $user->hasPermissionTo('update-scenarios');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Scenario $scenario): bool
    {
        return $user->hasPermissionTo('delete-scenarios');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Scenario $scenario): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Scenario $scenario): bool
    {
        return false;
    }
}
