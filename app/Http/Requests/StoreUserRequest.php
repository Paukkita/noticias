<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
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
            'name' => [
            'required',
            'string',
            'unique:users'
        ],
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ];
    }
    public function messages()
    { return  [
        'name.unique'=>'El :attribute ya existe, create otro nombre de usuario',
        'name.required'=>'El :attribute es obligatorio',
        'name.string'=>'El :attribute debe ser un string',
        'email.required'=>'El :attribute es obligatorio',
        'email.email'=>'El :attribute debe ser un email',
        'email.unique'=>'El :attribute ya existe, introduce otro email',
        'password.required'=>'El :attribute es obligatorio'
    ];
    }
}
