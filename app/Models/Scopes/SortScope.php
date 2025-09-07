<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class SortScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        // Ordenar por campos
        // Si no existe la variable sort en los parametros retornamos directamente
        if (empty(request(key: 'sort'))) {
            return;
        }

        // Convertimos en array el string separado por comas
        $sortFields = explode(',', request('sort'));

        // Ordenamos por los campos que se envian en el sort
        foreach ($sortFields as $sortField) {
            $direction = 'asc';

            // Si el campo empieza con - es descendente
            if (str_starts_with($sortField, '-')) {
                $direction = 'desc';
                $sortField = substr($sortField, 1);
            }

            // Ordenamos por el campo y la direccion
            $builder->orderBy($sortField, $direction);
        }
    }
}
