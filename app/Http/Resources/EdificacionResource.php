<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EdificacionResource extends JsonResource
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
            'nombre' => $this->nombre,
            'habitante_contacto' => $this->habitante_contacto,
            'telefono_contacto' => $this->telefono_contacto,
            'email_contacto' => $this->email_contacto,
            'area_construccion' => $this->area_construccion,
            'niveles_sobre_suelo' => $this->niveles_sobre_suelo,
            'niveles_bajo_suelo' => $this->niveles_bajo_suelo,
            'direccion_id' => $this->direccion_id,
            'ocupacion_id' => $this->ocupacion_id
        ];
    }
}
