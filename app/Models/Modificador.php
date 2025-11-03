<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modificador extends Model
{
    protected $table = 'modificadores';

    protected $fillable = [
        'tema',
        'descripcion',
        'puntuacion',
        'condicion',
    ];
}
