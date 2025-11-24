<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EvaluacionPresismicaDetalladaModificadorRequest extends FormRequest
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
            'e_presismica_detallada_id' => ['required', 'exists:e_presismicas_detalladas,id'],
            'modificador_id' => ['required', 'exists:modificadores,id'],
        ];
    }
}
