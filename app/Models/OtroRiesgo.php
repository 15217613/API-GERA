<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OtroRiesgo extends Model
{
    protected $table = 'otros_riesgos';

    protected $fillable = [
        'nombre',
    ];
}
