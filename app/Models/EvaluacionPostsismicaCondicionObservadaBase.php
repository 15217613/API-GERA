<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvaluacionPostsismicaCondicionObservadaBase extends Model
{
    protected $table = 'eval_post_c_observadas_bases';

    protected $fillable = [
        'evaluacion_postsismica_id',
        'condicion_base_id',
    ];

    public function evaluacion_postsismica()
    {
        return $this->belongsTo(EvaluacionPostsismica::class);
    }

    public function condicion_base()
    {
        return $this->belongsTo(CondicionBase::class);
    }
}
