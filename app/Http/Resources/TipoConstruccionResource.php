<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TipoConstruccionResource extends JsonResource
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
            'puntaje_base' => $this->puntaje_base,
            'puntaje_minimo' => $this->puntaje_minimo,
            'nombre' => $this->nombre,
            'clave' => $this->clave,
        ];
    }
}
