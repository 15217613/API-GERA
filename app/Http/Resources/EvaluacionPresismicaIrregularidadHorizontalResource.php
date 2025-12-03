<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EvaluacionPresismicaIrregularidadHorizontalResource extends JsonResource
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
            'evaluacion_presismica_id' => $this->e_presismica_id,
            'irregularidad_horizontal_id' => $this->i_horizontal_id,
        ];
    }
}
