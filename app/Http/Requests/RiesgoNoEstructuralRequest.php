<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RiesgoNoEstructuralRequest extends FormRequest
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
            'comentario' => ['required'],
            'condicion_no_estructural_id' => ['required', 'exists:condiciones_no_estructurales,id'],
        ];
    }
}
