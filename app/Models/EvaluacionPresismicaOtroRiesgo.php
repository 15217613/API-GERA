<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvaluacionPresismicaOtroRiesgo extends Model
{
    protected $table = 'eval_p_otros_riesgos';

    protected $fillable = [
        'e_presismica_id',
        'o_riesgo_id',
    ];

    public function evaluacionPresismica()
    {
        return $this->belongsTo(EvaluacionPresismica::class, 'e_presismica_id');
    }

    public function otroRiesgo()
    {
        return $this->belongsTo(OtroRiesgo::class, 'o_riesgo_id');
    }
}
