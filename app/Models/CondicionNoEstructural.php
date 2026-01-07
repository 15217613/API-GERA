<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CondicionNoEstructural extends Model
{
    protected $table = 'condiciones_no_estructurales';

    protected $fillable = [
        'ubicacion',
        'nombre',
    ];
}
