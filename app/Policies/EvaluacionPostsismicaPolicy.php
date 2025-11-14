<?php

namespace App\Policies;

use App\Models\User;
use App\Models\EvaluacionPostsismica;

class EvaluacionPostsismicaPolicy
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
        return $user->can('view-evaluacion-postsismica');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, EvaluacionPostsismica $evaluacionPostsismica): bool
    {
        // Solo puede acceder si tiene el permiso específico
        return $user->can('view-evaluacion-postsismica');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Solo puede acceder si tiene el permiso específico
        return $user->can('create-evaluacion-postsismica');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, EvaluacionPostsismica $evaluacionPostsismica): bool
    {
        // Solo puede acceder si tiene el permiso específico
        return $user->can('update-evaluacion-postsismica');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, EvaluacionPostsismica $evaluacionPostsismica): bool
    {
        // Solo puede acceder si tiene el permiso específico
        return $user->can('delete-evaluacion-postsismica');
    }
}
