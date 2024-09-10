<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidarDocumentoRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Permitir a execução da requisição
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->user,
            'document' => ['required', 'string', function ($attribute, $value, $fail) {
                if (!\Validator::make([$attribute => $value], ['document' => 'cpf'])->passes() &&
                    !\Validator::make([$attribute => $value], ['document' => 'cnpj'])->passes()) {
                    $fail('O campo ' . $attribute . ' deve ser um CPF ou CNPJ válido.');
                }
            }],
        ];
    }

    public function messages()
    {
        return [
            'document.required' => 'O campo documento é obrigatório.',
            'email.unique' => 'O e-mail já está em uso.',
        ];
    }

    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $response = response()->json([
            'success' => false,
            'message' => 'Erros de validação.',
            'errors' => $validator->errors(),
        ], 422);

        throw new \Illuminate\Validation\ValidationException($validator, $response);
    }

}
