<?php

namespace App\Policies;

use App\Models\Proyecto;
use App\Models\User;
class ProyectoPolicy
{

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(?User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, Proyecto $proyecto): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Proyecto $proyecto): bool
    {
        return $user->esDocente() && $user->id == $proyecto->docente_id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Proyecto $proyecto): bool
    {
        return $user->esPropietario($proyecto);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Proyecto $proyecto): bool
    {
        return $user->esPropietario($proyecto);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(): bool
    {
        return false;
    }
}
