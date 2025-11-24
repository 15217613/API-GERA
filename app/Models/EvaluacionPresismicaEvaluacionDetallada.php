<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvaluacionPresismicaEvaluacionDetallada extends Model
{
    protected $table = 'eval_p_e_presismicas_detalladas';

    protected $fillable = [
        'e_presismica_id',
        'e_p_detallada_id',
    ];

    public function e_presismica()
    {
        return $this->belongsTo(EvaluacionPresismica::class);
    }

    public function e_p_detallada()
    {
        return $this->belongsTo(EPresismicaDetallada::class);
    }
}
