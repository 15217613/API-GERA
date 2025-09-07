<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class SelectScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        // Seleccionar campos
        // Si no existe la variable select en los parametros retornamos directamente
        if (empty(request(key: 'select'))) {
            return;
        }

        // Si se envia el select en los parametros
        $select = request('select');

        // Convertimos en array el string separado por comas
        $selectArray = explode(',', $select);

        // Devolvemos solo los campos que se envian en el select
        $builder->select($selectArray);
    }
}
