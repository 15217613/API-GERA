<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EPresismicaDetalladaResource extends JsonResource
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
            'anio_construccion' => $this->anio_construccion,
            'autoconstruccion' => $this->autoconstruccion,
            'anio_ampliacion' => $this->anio_ampliacion,
            'licuefaccion' => $this->licuefaccion,
            'deslizamiento' => $this->deslizamiento,
            'ruptura_superficie' => $this->ruptura_superficie,
            'golpeo_adyacente' => $this->golpeo_adyacente,
            'riesgo_caida' => $this->riesgo_caida,
            'comentario' => $this->comentario,
            'croquis' => $this->croquis,
            'fotografia' => $this->fotografia,
            'puntaje_final' => $this->puntaje_final,
            'revision_exterior' => $this->revision_exterior,
            'revision_interior' => $this->revision_interior,
            'planos_revisados' => $this->planos_revisados,
            'fuente_tipo_suelo' => $this->fuente_tipo_suelo,
            'fuente_riesgo_geologico' => $this->fuente_riesgo_geologico,
            'version' => $this->version,
            'tipo_suelo_id' => $this->tipo_suelo_id,
            'tipo_construccion_id' => $this->tipo_construccion_id,
        ];
    }
}
