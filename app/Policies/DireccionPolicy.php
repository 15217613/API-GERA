<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Direccion;
use Illuminate\Auth\Access\Response;

class DireccionPolicy
{
    /**
     * Aplica antes de los demás métodos.
     * Permite que el 'admin' o el superusuario salte las verificaciones.
     */
    public function before(User $user, string $ability): ?bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        return null; // Si no es Admin, continúa al método viewAny
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Solo puede acceder si tiene el permiso específico
        return $user->can('view-direccion');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Direccion $direccion): bool
    {
        // Solo puede acceder si tiene el permiso específico
        return $user->can('view-direccion');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Solo puede acceder si tiene el permiso específico
        return $user->can('create-direccion');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Direccion $direccion): bool
    {
        // Solo puede acceder si tiene el permiso específico
        return $user->can('update-direccion');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Direccion $direccion): bool
    {
        // Solo puede acceder si tiene el permiso específico
        return $user->can('delete-direccion');
    }
}
