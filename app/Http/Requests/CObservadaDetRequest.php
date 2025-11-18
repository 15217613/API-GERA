<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CObservadaDetRequest extends FormRequest
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
            'grado_danio_id' => ['required', 'exists:grado_danios,id'],
            'condicion_detallada_id' => ['required', 'exists:condiciones_detalladas,id'],
            'comentario' => ['nullable', 'string'],
            'postsismica_detallada_id' => ['required', 'exists:e_postsismicas_detalladas,id'],
        ];
    }
}
