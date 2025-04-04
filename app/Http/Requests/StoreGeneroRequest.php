<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGeneroRequest extends FormRequest
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
            'genero' => 'required|string|unique:generos'
        ];
    }

    public function messages()
    {
        return [
            'genero.required' => 'El :attribute es obligatorio.',
            'genero.string' => 'El :attribute debe ser un texto.',
            'genero.unique' => 'El :attribute ya existe.',

        ];
    }
}
