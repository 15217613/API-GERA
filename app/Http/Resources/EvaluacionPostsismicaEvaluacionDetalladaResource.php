<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EvaluacionPostsismicaEvaluacionDetalladaResource extends JsonResource
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
            'evaluacion_postsismica_id' => $this->evaluacion_postsismica_id,
            'evaluacion_detallada_id' => $this->evaluacion_detallada_id,
        ];
    }
}
