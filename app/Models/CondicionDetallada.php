<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CondicionDetallada extends Model
{
    protected $table = 'condiciones_detalladas';

    protected $fillable = [
        'nombre',
    ];
}
