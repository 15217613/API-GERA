<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvaluacionPostsismica extends Model
{
    protected $table = 'evaluaciones_postsismicas';

    protected $fillable = [
        'fecha',
        'hora',
        'numero_unidades_residenciales',
        'numero_unidades_residenciales_habitables',
        'comentario_senial',
        'evaluacion_detallada_recomendada_estructural',
        'evaluacion_detallada_recomendada_geotecnia',
        'otras_recomendaciones',
        'comentarios',
        'evaluacion_detallada_recomendada_otra',
        'version',
        'senializacion_id',
        'porcentaje_danio_id',
    ];

    protected $casts = [
        'fecha' => 'date:Y-m-d',
        'hora' => 'date:H:i',
    ];

    public function senializacion()
    {
        return $this->belongsTo(Senializacion::class);
    }

    public function porcentaje_danio()
    {
        return $this->belongsTo(PorcentajeDanio::class);
    }
}
