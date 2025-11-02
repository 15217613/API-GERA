<?php

namespace App\Policies;

use App\Models\User;
use App\Models\SNoEstructural;
use Illuminate\Auth\Access\Response;

class SNoEstructuralPolicy
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
        return $user->can('view-sismico-no-estructural');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, SNoEstructural $sNoEstructural): bool
    {
        return $user->can('view-sismico-no-estructural');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create-sismico-no-estructural');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, SNoEstructural $sNoEstructural): bool
    {
        return $user->can('update-sismico-no-estructural');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, SNoEstructural $sNoEstructural): bool
    {
        return $user->can('delete-sismico-no-estructural');
    }
}
