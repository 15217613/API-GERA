<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GradoDanio extends Model
{
    protected $table = 'grado_danios';

    protected $fillable = [
        'nombre',
    ];
}
