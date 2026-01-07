<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EdificacionEvaluacionPostsismica extends Model
{
    protected $table = 'edif_eval_postsismicas';

    protected $fillable = [
        'edificacion_id',
        'evaluacion_postsismica_id',
    ];

    public function edificacion()
    {
        return $this->belongsTo(Edificacion::class);
    }

    public function evaluacion_postsismica()
    {
        return $this->belongsTo(EvaluacionPostsismica::class);
    }
}
