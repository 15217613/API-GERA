<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EvaluacionPostsismicaCondicionObservadaBaseRequest extends FormRequest
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
            'condicion_base_id' => 'required|exists:condiciones_base,id',
            'evaluacion_postsismica_id' => 'required|exists:evaluaciones_postsismicas,id',
        ];
    }
}
