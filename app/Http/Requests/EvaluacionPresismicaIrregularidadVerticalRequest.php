<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EvaluacionPresismicaIrregularidadVerticalRequest extends FormRequest
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
            'e_presismica_id' => ['required', 'exists:evaluaciones_presismicas,id'],
            'i_vertical_id' => ['required', 'exists:irregularidades_verticales,id'],
        ];
    }
}
