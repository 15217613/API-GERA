<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EPostsismicaDetalladaRequest extends FormRequest
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
        $isUpdate = $this->route('id') !== null;

        return [
            'croquis' => [$isUpdate ? 'sometimes' : 'required', 'image'],
            'fotografia' => [$isUpdate ? 'sometimes' : 'required', 'image'],
            'version' => ['required', 'integer'],
        ];
    }
}
