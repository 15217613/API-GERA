<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiesgoNoEstructural extends Model
{
    protected $table = 'riesgos_no_estructurales';

    protected $fillable = [
        'comentario',
        'condicion_no_estructural_id',
    ];

    public function condicionNoEstructural()
    {
        return $this->belongsTo(CondicionNoEstructural::class);
    }
}
