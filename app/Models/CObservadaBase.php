<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CObservadaBase extends Model
{
    protected $table = 'c_observadas_base';

    protected $fillable = [
        'grado_danio_id',
        'condicion_base_id',
        'comentario',
    ];

    public function gradoDanio()
    {
        return $this->belongsTo(GradoDanio::class);
    }

    public function condicionBase()
    {
        return $this->belongsTo(CondicionBase::class);
    }
}
