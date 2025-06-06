<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNoticiaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titulo' => 'required|string|max:60',
            'fecha_publicacion' => 'required|date',
            'descripcion' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'genero_id' => 'required|',
        ];
    }

    public function messages()
    {
        return [
            'titulo.required' => 'El :attribute es obligatorio.',
            'titulo.string' => 'El :attribute debe ser un texto.',
            'titulo.max' => 'El :attribute no puede superar los 36 caracteres.',
            'fecha_publicacion.required' => 'La :attribute es obligatoria.',
            'fecha_publicacion.date' => 'La :attribute debe ser una fecha válida.',
            'descripcion.required' => 'La :attribute es obligatoria.',
            'descripcion.string' => 'La :attribute debe ser un texto.',
            'descripcion.max' => 'La :attribute no puede superar los 255 caracteres.',
            'imagen.image' => 'El archivo :attribute debe ser una imagen.',
            'imagen.mimes' => 'El :attribute debe ser de tipo: jpeg, png, jpg, gif, svg.',
            'imagen.max' => 'El :attribute no puede superar los 2MB.',
            'genero.required' => 'El :attribute es obligatorio.',
        ];
    }
}
