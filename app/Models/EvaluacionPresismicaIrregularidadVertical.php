<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvaluacionPresismicaIrregularidadVertical extends Model
{
    protected $table = 'eval_p_irregularidades_verticales';

    protected $fillable = [
        'e_presismica_id',
        'i_vertical_id',
    ];

    public function evaluacionPresismica()
    {
        return $this->belongsTo(EvaluacionPresismica::class, 'e_presismica_id');
    }

    public function irregularidadVertical()
    {
        return $this->belongsTo(IrregularidadVertical::class, 'i_vertical_id');
    }
}
