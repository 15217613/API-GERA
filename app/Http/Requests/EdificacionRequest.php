<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EdificacionRequest extends FormRequest
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
            'nombre' => ['required', 'string', 'max:255'],
            'habitante_contacto' => ['required', 'string', 'max:255'],
            'telefono_contacto' => ['required', 'string', 'max:255'],
            'email_contacto' => ['required', 'string', 'max:255'],
            'area_construccion' => ['required', 'numeric'],
            'niveles_sobre_suelo' => ['required', 'numeric'],
            'niveles_bajo_suelo' => ['required', 'numeric'],
            'direccion_id' => ['required', 'exists:direcciones,id'],
            'ocupacion_id' => ['required', 'exists:ocupaciones,id'],
        ];
    }
}
