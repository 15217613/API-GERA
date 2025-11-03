<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IrregularidadVertical extends Model
{
    protected $table = 'irregularidades_verticales';

    protected $fillable = [
        'nombre',
        'gravedad',
    ];
}
