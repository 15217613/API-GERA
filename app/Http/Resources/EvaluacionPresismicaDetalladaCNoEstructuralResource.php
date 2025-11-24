<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EvaluacionPresismicaDetalladaCNoEstructuralResource extends JsonResource
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
            'e_presismica_detallada_id' => $this->e_presismica_detallada_id,
            'condicion_no_estructural_id' => $this->condicion_no_estructural_id,
            'comentario' => $this->comentario,
            'existencia' => $this->existencia,
        ];
    }
}
