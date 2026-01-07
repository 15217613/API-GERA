<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvaluacionPostsismicaSistemaConstruccion extends Model
{
    protected $table = 'eval_post_s_construcciones';

    protected $fillable = [
        'evaluacion_postsismica_id',
        'sistema_construccion_id',
    ];

    public function evaluacion_postsismica()
    {
        return $this->belongsTo(EvaluacionPostsismica::class);
    }

    public function sistema_construccion()
    {
        return $this->belongsTo(SistemaConstruccion::class);
    }
}
