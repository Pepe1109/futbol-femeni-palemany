<?php

namespace App\Policies;

use App\Models\Equip;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;

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
    // Si es ADMIN, permiso total.
    if ($user->role === 'admin') {
        return true;
    }

    // Si es MANAGER, solo si su team_id coincide con el id del equipo
    if ($user->role === 'manager') {
        return $user->team_id === $equip->id;
    }

    // Si no es nada de eso, prohibido.
    return false;
}

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Equip $equip): bool
    {
        return $user->role === 'admin';
    }
}