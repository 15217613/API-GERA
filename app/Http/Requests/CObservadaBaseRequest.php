<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CObservadaBaseRequest extends FormRequest
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
            'condicion_base_id' => ['required', 'exists:condiciones_base,id'],
            'comentario' => ['nullable', 'string'],
        ];
    }
}
