<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IrregularidadHorizontal extends Model
{
    protected $table = 'irregularidades_horizontales';

    protected $fillable = [
        'nombre',
    ];
}
