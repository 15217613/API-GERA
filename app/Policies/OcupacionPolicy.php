<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Ocupacion;
use Illuminate\Auth\Access\Response;

class OcupacionPolicy
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
        return $user->can('view-ocupacion');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Ocupacion $ocupacion): bool
    {
        // Solo puede acceder si tiene el permiso específico
        return $user->can('view-ocupacion');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Solo puede acceder si tiene el permiso específico
        return $user->can('create-ocupacion');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Ocupacion $ocupacion): bool
    {
        // Solo puede acceder si tiene el permiso específico
        return $user->can('update-ocupacion');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Ocupacion $ocupacion): bool
    {
        // Solo puede acceder si tiene el permiso específico
        return $user->can('delete-ocupacion');
    }
}
