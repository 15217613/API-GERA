<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EPresismicaDetalladaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $isUpdate = $this->route('id') !== null;

        return [
            'anio_construccion' => ['required', 'numeric'],
            'autoconstruccion' => ['required', 'numeric'],
            'anio_ampliacion' => ['required', 'numeric'],
            'licuefaccion' => ['required', 'numeric'],
            'deslizamiento' => ['required', 'numeric'],
            'ruptura_superficie' => ['required', 'numeric'],
            'golpeo_adyacente' => ['required', 'numeric'],
            'riesgo_caida' => ['required', 'numeric'],
            'comentario' => ['required', 'string'],
            'croquis' => [$isUpdate ? 'sometimes' : 'required', 'image'],
            'fotografia' => [$isUpdate ? 'sometimes' : 'required', 'image'],
            'puntaje_final' => ['required', 'numeric'],
            'revision_exterior' => ['required', 'numeric'],
            'revision_interior' => ['required', 'numeric'],
            'planos_revisados' => ['required', 'numeric'],
            'fuente_tipo_suelo' => ['required', 'string'],
            'fuente_riesgo_geologico' => ['required', 'string'],
            'version' => ['required', 'numeric'],
            'tipo_suelo_id' => ['required', 'numeric'],
            'tipo_construccion_id' => ['required', 'numeric'],
        ];
    }
}
