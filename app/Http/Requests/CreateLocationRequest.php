<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class CreateLocationRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'country' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'district' => 'required|string|max:100',
            'street' => 'required|string|max:255',
            'address_line' => 'required|string|max:255',
            'reference_point' => 'nullable|string|max:255',
            'postal_code' => [
                'required',
                'string',
                'max:20',
                Rule::when($this->country === 'Brasil', [
                    'regex:/^\d{5}-\d{3}$/'
                ])
            ],
            'latitude' => [
                'nullable',
                'numeric',
                'between:-90,90',
                'regex:/^-?\d{1,3}\.\d{1,8}$/'
            ],
            'longitude' => [
                'nullable',
                'numeric',
                'between:-180,180',
                'regex:/^-?\d{1,3}\.\d{1,8}$/'
            ],
        ];
    }

    /**
     * Custom validation messages
     */
    public function messages(): array
    {
        return [
            'country.required' => 'O país é obrigatório.',
            'state.required' => 'O estado é obrigatório.',
            'city.required' => 'A cidade é obrigatória.',
            'district.required' => 'O bairro é obrigatório.',
            'street.required' => 'A rua é obrigatória.',
            'address_line.required' => 'O endereço completo é obrigatório.',
            'postal_code.required' => 'O CEP é obrigatório.',
            'postal_code.regex' => 'O CEP brasileiro deve estar no formato 00000-000.',
            'latitude.numeric' => 'A latitude deve ser um valor numérico.',
            'latitude.between' => 'A latitude deve estar entre -90 e 90 graus.',
            'latitude.regex' => 'Formato de latitude inválido.',
            'longitude.numeric' => 'A longitude deve ser um valor numérico.',
            'longitude.between' => 'A longitude deve estar entre -180 e 180 graus.',
            'longitude.regex' => 'Formato de longitude inválido.',
        ];
    }

    /**
     * Handle a failed validation attempt.
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => 'Erro de validação',
                'errors' => $this->formatErrors($validator),
            ], 422)
        );
    }

    /**
     * Format the validation errors in a consistent structure.
     */
    protected function formatErrors(Validator $validator): array
    {
        $errors = $validator->errors()->toArray();

        $formattedErrors = [];
        foreach ($errors as $field => $messages) {
            $formattedErrors[] = [
                'field' => $field,
                'messages' => $messages
            ];
        }

        return $formattedErrors;
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'latitude' => $this->latitude ? (float)$this->latitude : null,
            'longitude' => $this->longitude ? (float)$this->longitude : null,
            'country' => $this->country ? ucfirst(mb_strtolower($this->country)) : null,
        ]);
    }
}
