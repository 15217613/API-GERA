<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CondicionBase extends Model
{
    protected $table = 'condiciones_base';

    protected $fillable = [
        'nombre',
    ];
}
