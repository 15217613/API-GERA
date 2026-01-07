<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EvaluacionPostsismicaEvaluacionDetalladaRequest extends FormRequest
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
            'evaluacion_postsismica_id' => 'required|exists:evaluaciones_postsismicas,id',
            'evaluacion_detallada_id' => 'required|exists:e_postsismicas_detalladas,id',
        ];
    }
}
