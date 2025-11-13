<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EvaluacionPresismicaRequest extends FormRequest
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
            'anio_construccion' => ['required', 'integer'],
            'autoconstruccion' => ['required', 'integer'],
            'anio_ampliacion' => ['required', 'integer'],
            'licuefaccion' => ['required', 'integer'],
            'deslizamiento' => ['required', 'integer'],
            'ruptura_superficie' => ['required', 'integer'],
            'golpeo_adyacente' => ['required', 'integer'],
            'riesgo_caida' => ['required', 'integer'],
            'comentario' => ['required', 'string'],
            'croquis' => [$isUpdate ? 'sometimes' : 'required', 'image'],
            'fotografia' => [$isUpdate ? 'sometimes' : 'required', 'image'],
            'puntaje_final' => ['required', 'decimal:2'],
            'revision_exterior' => ['required', 'integer'],
            'revision_interior' => ['required', 'integer'],
            'planos_revisados' => ['required', 'integer'],
            'fuente_tipo_suelo' => ['required', 'string'],
            'fuente_riesgo_geologico' => ['required', 'string'],
            'version' => ['required', 'integer'],
            'tipo_suelo_id' => ['required', 'integer', 'exists:tipos_suelos,id'],
            'tipo_construccion_id' => ['required', 'integer', 'exists:tipos_construcciones,id'],
        ];
    }
}
