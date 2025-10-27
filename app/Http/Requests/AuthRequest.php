<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
        $rules = [
            'email' => 'required|string|email',
            'password' => 'required|string|min:8',
        ];

        // Obtener el valor de 'grant_type' del cuerpo de la petición.
        // Asumo que tu lógica $grantType se obtiene de $request->input('grant_type') o similar.
        $grantType = $this->input('grant_type');

        // Si es password grant, requerir client_id y client_secret
        if ($grantType === 'password') {
            $rules['client_id'] = 'required|string';
            $rules['client_secret'] = 'required|string';
        }

        return $rules;
    }
}
