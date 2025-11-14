<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class EvaluacionPostsismicaRequest extends FormRequest
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
        return [
            'fecha' => ['required', 'date'],
            'hora' => ['required', Rule::date()->format('H:i')],
            'numero_unidades_residenciales' => ['required', 'integer'],
            'numero_unidades_residenciales_habitables' => ['required', 'integer'],
            'comentario_senial' => ['required', 'string'],
            'evaluacion_detallada_recomendada_estructural' => ['required', 'string'],
            'evaluacion_detallada_recomendada_geotecnia' => ['required', 'string'],
            'otras_recomendaciones' => ['required', 'string'],
            'comentarios' => ['required', 'string'],
            'evaluacion_detallada_recomendada_otra' => ['required', 'string'],
            'version' => ['required', 'string'],
            'senializacion_id' => ['required', 'exists:senializaciones,id'],
            'porcentaje_danio_id' => ['required', 'exists:porcentaje_danios,id'],
        ];
    }
}
