<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoSuelo extends Model
{
    protected $table = 'tipos_suelos';

    protected $fillable = [
        'clave',
        'nombre',
    ];
}
