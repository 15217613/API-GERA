<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EvaluacionPostsismicaCondicionObservadaBaseResource extends JsonResource
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
            'condicion_base_id' => $this->condicion_base_id,
            'evaluacion_postsismica_id' => $this->evaluacion_postsismica_id,
        ];
    }
}
