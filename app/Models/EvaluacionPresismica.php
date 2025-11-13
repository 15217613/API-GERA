<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvaluacionPresismica extends Model
{
    protected $table = 'evaluaciones_presismicas';

    protected $fillable = [
        'anio_construccion',
        'autoconstruccion',
        'anio_ampliacion',
        'licuefaccion',
        'deslizamiento',
        'ruptura_superficie',
        'golpeo_adyacente',
        'riesgo_caida',
        'comentario',
        'croquis',
        'fotografia',
        'puntaje_final',
        'revision_exterior',
        'revision_interior',
        'planos_revisados',
        'fuente_tipo_suelo',
        'fuente_riesgo_geologico',
        'version',
        'tipo_suelo_id',
        'tipo_construccion_id',
    ];

    protected $casts = [
        'puntaje_final' => 'float',
        'anio_construccion' => 'integer',
        'anio_ampliacion' => 'integer',
    ];

    public function tipoSuelo()
    {
        return $this->belongsTo(TipoSuelo::class);
    }

    public function tipoConstruccion()
    {
        return $this->belongsTo(TipoConstruccion::class);
    }
}
