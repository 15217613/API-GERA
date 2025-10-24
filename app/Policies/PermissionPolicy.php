<?php

namespace App\Policies;

use App\Models\User;
use Spatie\Permission\Models\Permission;

class PermissionPolicy
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
     * Determina si el usuario puede ver la lista de permisos (método index).
     */
    public function viewAny(User $user): bool
    {
        // Solo puede acceder si tiene el permiso específico
        return $user->can('view-permissions');
    }

    /**
     * Determina si el usuario puede ver un permiso específico (método show).
     */
    public function view(User $user, Permission $permission): bool
    {
        // Se puede usar el mismo permiso 'view-permissions' o uno más específico
        return $user->can('view-permissions');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create-permissions');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Permission $permission): bool
    {
        return $user->can('update-permissions');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Permission $permission): bool
    {
        return $user->can('delete-permissions');
    }
}
