<?php

namespace App\Http\Requests;

class CreateCustomerRequest extends BaseFormRequest
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
            'email' => 'required|email|max:255|unique:customers,email',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'zipcode' => 'nullable|string|max:20',
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
            
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'O e-mail deve ser um endereço de e-mail válido.',
            'email.max' => 'O e-mail não pode ultrapassar 255 caracteres.',
            'email.unique' => 'O e-mail informado já está em uso.',
            
            'phone.required' => 'O campo telefone é obrigatório.',
            'phone.string' => 'O telefone deve ser uma string válida.',
            'phone.max' => 'O telefone não pode ultrapassar 20 caracteres.',
            
            'address.string' => 'O endereço deve ser uma string válida.',
            'address.max' => 'O endereço não pode ultrapassar 255 caracteres.',
            
            'city.string' => 'A cidade deve ser uma string válida.',
            'city.max' => 'A cidade não pode ultrapassar 255 caracteres.',
            
            'state.string' => 'O estado deve ser uma string válida.',
            'state.max' => 'O estado não pode ultrapassar 255 caracteres.',
            
            'zipcode.string' => 'O CEP deve ser uma string válida.',
            'zipcode.max' => 'O CEP não pode ultrapassar 20 caracteres.',
        ];
    }
}
