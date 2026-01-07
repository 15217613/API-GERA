<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SNoEstructural extends Model
{
    protected $table = 's_no_estructurales';

    protected $fillable = [
        'nombre',
        'accion',
    ];
}
