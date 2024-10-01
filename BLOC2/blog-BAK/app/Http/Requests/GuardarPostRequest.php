<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuardarPostRequest extends FormRequest
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
            'title' => 'required|unique:posts|min:5|max:255',
        ];
    }

    public function message()
    {
        return [
            'title.required' => "Informar titol",
            'title.unique' => "ole",
            'title.min' => "oletu",
            'title.max' => "ole2",
        ];
    }
}
