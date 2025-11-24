<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvaluacionPresismicaDetalladaModificador extends Model
{
    protected $table = 'eval_p_d_modificadores';

    protected $fillable = [
        'e_presismica_detallada_id',
        'modificador_id',
    ];

    public function e_presismica_detallada()
    {
        return $this->belongsTo(EPresismicaDetallada::class);
    }

    public function modificador()
    {
        return $this->belongsTo(Modificador::class);
    }
}
