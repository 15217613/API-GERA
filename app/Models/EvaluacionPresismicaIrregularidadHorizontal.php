<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvaluacionPresismicaIrregularidadHorizontal extends Model
{
    protected $table = 'eval_p_irregularidades_horizontales';

    protected $fillable = [
        'e_presismica_id',
        'i_horizontal_id',
    ];

    public function evaluacionPresismica()
    {
        return $this->belongsTo(EvaluacionPresismica::class);
    }

    public function irregularidadHorizontal()
    {
        return $this->belongsTo(IrregularidadHorizontal::class);
    }
}
