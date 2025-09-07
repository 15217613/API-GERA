<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Scopes\SortScope;
use App\Models\Scopes\SelectScope;
use App\Models\Scopes\FilterScope;
use App\Models\Scopes\IncludeScope;

class Api extends Model
{
    // Agrega los scopes globales
    protected static function booted(): void
    {
        static::addGlobalScopes([
            SortScope::class,
            FilterScope::class,
            SelectScope::class,
            IncludeScope::class
        ]);
    }

    // Agrega el scope local
    public function scopeGetOrPaginate($query): mixed {
        // Paginacion
        if (request('perPage')) {
            // Paginamos si se envia el perPage en los parametros
            return $query->paginate(request('perPage'));
        }

        // Si no se envia el perPage retornamos todos los registros
        return $query->get();
    }
}
