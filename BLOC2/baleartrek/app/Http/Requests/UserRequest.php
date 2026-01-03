<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
           'name' => 'required|min:5|max:255',
           'lastname' => 'required|min:5|max:255',
           'dni' => 'required|unique:users|min:5|max:255',
           'email' => 'required|unique:users|min:5|max:255', 
           'phone' => 'required|min:5|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "Has d'informar un nom",
            'lastname.required' => "Has d'informar un llinatge",
            'dni.required' => "Has d'informar un DNI",
            'email.required' => "Has d'informar un email",
            'phone.required' => "Has d'informar un telèfon",
            'dni.unique' => "El DNI ja està registrat",
            'email.unique' => "L'email ja està registrat",
        ];
    }
}
