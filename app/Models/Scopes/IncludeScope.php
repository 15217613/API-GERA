<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;

class IncludeScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        // Incluir relaciones
        // Si no existe la variable include en los parametros retornamos directamente
        if (empty(request(key: 'include'))) {
            return;
        }

        if (request('include')) {
            // Convertimos en array el string separado por comas
            $include = explode(',', request('include'));

            // Incluimos las relaciones
            $builder->with($include);
        }
    }
}
