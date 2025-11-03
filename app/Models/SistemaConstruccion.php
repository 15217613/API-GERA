<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SistemaConstruccion extends Model
{
    protected $table = 'sistemas_construccion';

    protected $fillable = [
        'nombre',
    ];
}
