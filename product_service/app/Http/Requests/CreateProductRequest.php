<?php

namespace App\Http\Requests;

class CreateProductRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'qtd_available' => 'required|integer|min:0',
            'qtd_total' => 'required|integer|min:0',
        ];
    }

    /**
     * Get custom messages for validation errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.string' => 'O nome deve ser uma string válida.',
            'name.max' => 'O nome não pode ultrapassar 255 caracteres.',
            
            'description.required' => 'O campo descrição é obrigatório.',
            'description.string' => 'A descrição deve ser uma string válida.',
            
            'price.required' => 'O campo preço é obrigatório.',
            'price.numeric' => 'O preço deve ser um valor numérico.',
            'price.min' => 'O preço não pode ser negativo.',
            
            'qtd_available.required' => 'O campo quantidade disponível é obrigatório.',
            'qtd_available.integer' => 'A quantidade disponível deve ser um número inteiro.',
            'qtd_available.min' => 'A quantidade disponível não pode ser negativa.',
            
            'qtd_total.required' => 'O campo quantidade total é obrigatório.',
            'qtd_total.integer' => 'A quantidade total deve ser um número inteiro.',
            'qtd_total.min' => 'A quantidade total não pode ser negativa.',
        ];
    }
}
