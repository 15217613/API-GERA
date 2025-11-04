<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class TipoSueloRequest extends FormRequest
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
            'clave' => ['required', 'string', 'max:255', Rule::unique('tipos_suelos', 'clave')->ignore($this->route('tipo_suelo'))],
            'nombre' => ['required', 'string', 'max:255'],
        ];
    }
}
