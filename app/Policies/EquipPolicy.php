<?php

namespace App\Policies;

use App\Models\Equip;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class EquipPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Equip $equip): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Només admins poden crear equips nous
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Equip $equip): bool
    {
        // Permet si és admin O si és manager assignat a aquest equip
        return $user->role === 'admin' || 
               ($user->role === 'manager' && $user->team_id === $equip->id);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Equip $equip): bool
    {
        return $user->role === 'admin';
    }
}