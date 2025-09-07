<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;

class FilterScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        // Filtrar
        // Si no existe la variable filters en los parametros retornamos directamente
        if (empty(request(key: 'filters'))) {
            return;
        }

        // Si se envia el filters en los parametros
        $filters = request('filters');

        foreach ($filters as $field => $conditions) {
            foreach ($conditions as $operator => $value) {
                if (in_array($operator, ['=', '>', '<', '>=', '<=', '!='])) {
                    $builder->where($field, $operator, $value);
                }

                if ($operator === 'like') {
                    $builder->where($field, 'like', "%{$value}%");
                }
            }
        }
    }
}
