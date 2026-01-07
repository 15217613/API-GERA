<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EvaluacionPostsismicaSistemaConstruccionResource extends JsonResource
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
            'sistema_construccion_id' => $this->sistema_construccion_id,
        ];
    }
}
