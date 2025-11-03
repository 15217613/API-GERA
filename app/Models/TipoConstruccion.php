<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoConstruccion extends Model
{
    protected $table = 'tipos_construcciones';

    protected $fillable = [
        'puntaje_base',
        'puntaje_minimo',
        'nombre',
        'clave',
    ];
}
