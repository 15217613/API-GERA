<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccionRequerida extends Model
{
    protected $table = 'acciones_requeridas';

    protected $fillable = [
        'nombre',
        'evaluacion_detallada',
    ];
}
