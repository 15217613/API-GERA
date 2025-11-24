<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvaluacionPresismicaAccionRequerida extends Model
{
    protected $table = 'eval_p_acciones_requeridas';

    protected $fillable = [
        'evaluacion_presismica_id',
        'accion_requerida_id',
    ];

    public function evaluacionPresismica()
    {
        return $this->belongsTo(EvaluacionPresismica::class);
    }

    public function accionRequerida()
    {
        return $this->belongsTo(AccionRequerida::class);
    }
}
