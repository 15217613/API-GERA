<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EPresismicaDetallada extends Model
{
    protected $table = 'e_presismicas_detalladas';

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
