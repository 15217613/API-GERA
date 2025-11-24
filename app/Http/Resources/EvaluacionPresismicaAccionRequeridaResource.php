<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EvaluacionPresismicaAccionRequeridaResource extends JsonResource
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
            'evaluacion_presismica_id' => $this->evaluacion_presismica_id,
            'accion_requerida_id' => $this->accion_requerida_id,
        ];
    }
}
