<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CObservadaDetResource extends JsonResource
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
            'grado_danio_id' => $this->grado_danio_id,
            'condicion_detallada_id' => $this->condicion_detallada_id,
            'comentario' => $this->comentario,
            'postsismica_detallada_id' => $this->postsismica_detallada_id,
        ];
    }
}
