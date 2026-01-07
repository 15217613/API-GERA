<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvaluacionPostsismicaEvaluacionDetallada extends Model
{
    protected $table = 'eval_post_eval_detalladas';

    protected $fillable = [
        'evaluacion_postsismica_id',
        'evaluacion_detallada_id',
    ];

    public function evaluacion_postsismica()
    {
        return $this->belongsTo(EvaluacionPostsismica::class);
    }

    public function evaluacion_detallada()
    {
        return $this->belongsTo(EPostsismicaDetallada::class);
    }
}
