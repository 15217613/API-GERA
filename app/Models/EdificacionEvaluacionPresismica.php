<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EdificacionEvaluacionPresismica extends Model
{
    protected $table = 'edif_eval_presismicas';

    protected $fillable = [
        'edificacion_id',
        'evaluacion_presismica_id',
    ];

    public function edificacion()
    {
        return $this->belongsTo(Edificacion::class);
    }

    public function evaluacion_presismica()
    {
        return $this->belongsTo(EvaluacionPresismica::class);
    }
}
