<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PorcentajeDanio extends Model
{
    protected $table = 'porcentaje_danios';

    protected $fillable = [
        'rango',
    ];
}
