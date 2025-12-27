<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFornecedorRequest extends FormRequest
{
    /**
     * Autoriza a requisição.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Regras de validação.
     */
    public function rules(): array
    {
        return [
            'nome' => ['required', 'string', 'max:255'],
            'cnpj' => ['required', 'string', 'size:14', 'unique:fornecedores,cnpj'],
            'cep'  => ['required', 'string', 'size:8'],
        ];
    }

    /**
     * Mensagens customizadas (diferencial).
     */
    public function messages(): array
    {
        return [
            'cnpj.size' => 'O CNPJ deve conter 14 números.',
            'cep.size'  => 'O CEP deve conter 8 números.',
        ];
    }
}
