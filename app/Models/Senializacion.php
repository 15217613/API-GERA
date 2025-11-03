<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Senializacion extends Model
{
    protected $table = 'senializaciones';

    protected $fillable = [
        'nombre',
    ];
}
