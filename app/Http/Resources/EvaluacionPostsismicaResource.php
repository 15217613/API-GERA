<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EvaluacionPostsismicaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'fecha' => $this->fecha,
            'hora' => $this->hora,
            'numero_unidades_residenciales' => $this->numero_unidades_residenciales,
            'numero_unidades_residenciales_habitables' => $this->numero_unidades_residenciales_habitables,
            'comentario_senial' => $this->comentario_senial,
            'evaluacion_detallada_recomendada_estructural' => $this->evaluacion_detallada_recomendada_estructural,
            'evaluacion_detallada_recomendada_geotecnia' => $this->evaluacion_detallada_recomendada_geotecnia,
            'otras_recomendaciones' => $this->otras_recomendaciones,
            'comentarios' => $this->comentarios,
            'evaluacion_detallada_recomendada_otra' => $this->evaluacion_detallada_recomendada_otra,
            'version' => $this->version,
            'senializacion_id' => $this->senializacion_id,
            'porcentaje_danio_id' => $this->porcentaje_danio_id,
        ];
    }
}
