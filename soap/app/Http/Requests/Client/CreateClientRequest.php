<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateClientRequest extends FormRequest
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
            //
            'documento' => ['required','min:5', 'max:15', 'unique:clients,documento'],
            'nombres' => ['required', 'min:5', 'max:100'],
            'email' => ['required','unique:clients,email'],
            'celular' => ['required','unique:clients,celular'],
        ];
    }
}
