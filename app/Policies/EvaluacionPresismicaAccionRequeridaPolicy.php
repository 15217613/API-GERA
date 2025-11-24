<?php

namespace App\Policies;

use App\Models\User;
use App\Models\EvaluacionPresismicaAccionRequerida;

class EvaluacionPresismicaAccionRequeridaPolicy
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
        return $user->can('view-evaluacion-presismica-accion-requerida');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, EvaluacionPresismicaAccionRequerida $evaluacionPresismicaAccionRequerida): bool
    {
        // Solo puede acceder si tiene el permiso específico
        return $user->can('view-evaluacion-presismica-accion-requerida');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Solo puede acceder si tiene el permiso específico
        return $user->can('create-evaluacion-presismica-accion-requerida');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, EvaluacionPresismicaAccionRequerida $evaluacionPresismicaAccionRequerida): bool
    {
        // Solo puede acceder si tiene el permiso específico
        return $user->can('update-evaluacion-presismica-accion-requerida');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, EvaluacionPresismicaAccionRequerida $evaluacionPresismicaAccionRequerida): bool
    {
        // Solo puede acceder si tiene el permiso específico
        return $user->can('delete-evaluacion-presismica-accion-requerida');
    }
}
