<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvaluacionPresismicaDetalladaCNoEstructural extends Model
{
    protected $table = 'eval_p_d_c_no_estructurales';

    protected $fillable = [
        'e_presismica_detallada_id',
        'condicion_no_estructural_id',
        'comentario',
        'existencia',
    ];

    public function ePresismicaDetallada()
    {
        return $this->belongsTo(EPresismicaDetallada::class);
    }

    public function condicionNoEstructural()
    {
        return $this->belongsTo(CondicionNoEstructural::class);
    }
}
