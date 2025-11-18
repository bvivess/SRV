<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuardarUserRequest extends FormRequest
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
            'name'      => 'required|string|max:255',
            'lastname'  => 'required|string|max:255',
            //'email'     => 'required|string|max:255|unique:users',
            'password'  => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => "Has d'informar un títol",
            'title.unique' => " El títol ja existeix",
            'title.min' => "minim 5 car",
            'title.max' => "maxim 255 car",
        ];
    }
}
