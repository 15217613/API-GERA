<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TipoConstruccionRequest extends FormRequest
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
            'puntaje_base' => ['required', 'numeric'],
            'puntaje_minimo' => ['required', 'numeric'],
            'nombre' => ['required', 'string'],
            'clave' => ['required', 'string', 'max:255'],
        ];
    }
}
