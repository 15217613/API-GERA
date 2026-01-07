<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EdificacionEvaluacionPostsismicaResource extends JsonResource
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
            'edificacion_id' => $this->edificacion_id,
            'evaluacion_postsismica_id' => $this->evaluacion_postsismica_id,
        ];
    }
}
