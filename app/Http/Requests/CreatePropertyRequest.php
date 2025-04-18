<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class CreatePropertyRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'for_sale' => 'boolean',
            'for_rent' => 'boolean',
            'sale_price' => [
                'nullable',
                'numeric',
                'min:0',
                Rule::requiredIf(function () {
                    return $this->input('for_sale') == true;
                })
            ],
            'rent_price' => [
                'nullable',
                'numeric',
                'min:0',
                Rule::requiredIf(function () {
                    return $this->input('for_rent') == true;
                })
            ],
            'is_active' => 'boolean',
        ];
    }

    /**
     * Custom validation messages
     */
    public function messages(): array
    {
        return [
            'name.required' => 'O nome da propriedade é obrigatório.',,
            'sale_price.required' => 'O preço de venda é obrigatório quando "Para venda" está marcado.',
            'rent_price.required' => 'O preço de aluguel é obrigatório quando "Para alugar" está marcado.',
            'sale_price.numeric' => 'O preço de venda deve ser um valor numérico.',
            'rent_price.numeric' => 'O preço de aluguel deve ser um valor numérico.',
            'sale_price.min' => 'O preço de venda não pode ser negativo.',
            'rent_price.min' => 'O preço de aluguel não pode ser negativo.',
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
             'for_sale' => $this->boolean('for_sale'),
             'for_rent' => $this->boolean('for_rent'),
             'is_active' => $this->boolean('is_active'),
             'sale_price' => $this->for_sale ? $this->sale_price : null,
             'rent_price' => $this->for_rent ? $this->rent_price : null
         ]);
     }
}
