<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class AdCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $currentYear = date('Y');

        return [
            'property.name' => 'required|string|max:225',
            'property.for_sale' => 'boolean',
            'property.for_rent' => 'boolean',
            'property.sale_price' => [
                'nullable',
                'numeric',
                'min:0',
                Rule::requiredIf(function () {
                    return $this->input('property.for_sale') == true;
                })
            ],
            'property.rent_price' => [
                'nullable',
                'numeric',
                'min:0',
                Rule::requiredIf(function () {
                    return $this->input('property.for_rent') == true;
                })
            ],
            'property.is_active' => 'boolean',
            'location.country' => 'required|string|max:100',
            'location.state' => 'required|string|max:100',
            'location.city' => 'required|string|max:100',
            'location.district' => 'required|string|max:100',
            'location.street' => 'required|string|max:255',
            'location.address_line' => 'required|string|max:255',
            'location.reference_point' => 'nullable|string|max:255',
            'location.postal_code' => [
                'required',
                'string',
                'max:20',
                Rule::when($this->input('location.country') === 'Brasil', [
                    'regex:/^\d{5}-\d{3}$/'
                ])
            ],
            'location.latitude' => [
                'nullable',
                'numeric',
                'between:-90,90',
                'regex:/^-?\d{1,3}\.\d{1,8}$/'
            ],
            'location.longitude' => [
                'nullable',
                'numeric',
                'between:-180,180',
                'regex:/^-?\d{1,3}\.\d{1,8}$/'
            ],
            'details.type' => [
                'required',
                'string',
                Rule::in(['house', 'apartment', 'farm'])
            ],
            'details.size' => 'required|numeric|min:0',
            'details.bedrooms' => 'nullable|integer|min:0',
            'details.suites' => 'nullable|integer|min:0',
            'details.bathrooms' => 'nullable|integer|min:0',
            'details.garages' => 'nullable|integer|min:0',
            'details.living_rooms' => 'nullable|integer|min:0',
            'details.dining_rooms' => 'nullable|integer|min:0',
            'details.kitchens' => 'nullable|integer|min:0',
            'details.pools' => 'nullable|integer|min:0',
            'details.construction_year' => 'nullable|integer|min:1800|max:'.($currentYear + 1),
            'details.barbecue_area' => 'nullable|boolean',
            'details.pet_friendly' => 'nullable|boolean',
            'details.newer' => 'nullable|boolean',
            'details.condominium_fee' => 'nullable|numeric|min:0',
            'details.annual_tax' => 'nullable|numeric|min:0',
            'medias.title' => 'required|string|max:255',
            'medias.media_type' => [
                'required',
                'string',
                Rule::in(['image', 'video'])
            ],
            'medias.file_path' => 'required|string|max:255',
            'medias.file_type' => 'required|string|max:100',
            'medias.file_size' => 'required|integer|min:0'
        ];
    }

    public function messages(): array
    {
        return [
            'property.name.required' => 'O nome da propriedade é obrigatório.',
            'property.name.max' => 'O nome não pode ultrapassar 225 caracteres.',
            'property.for_sale.boolean' => 'O campo "para venda" deve ser verdadeiro ou falso.',
            'property.for_rent.boolean' => 'O campo "para aluguel" deve ser verdadeiro ou falso.',
            'property.is_active.boolean' => 'O campo "ativo" deve ser verdadeiro ou falso.',
            'property.sale_price.required' => 'O preço de venda é obrigatório quando o imóvel está marcado para venda.',
            'property.sale_price.numeric' => 'O preço de venda deve ser um valor numérico.',
            'property.sale_price.min' => 'O preço de venda não pode ser negativo.',
            'property.rent_price.required' => 'O preço de aluguel é obrigatório quando o imóvel está marcado para aluguel.',
            'property.rent_price.numeric' => 'O preço de aluguel deve ser um valor numérico.',
            'property.rent_price.min' => 'O preço de aluguel não pode ser negativo.',
            'location.country.required' => 'O país é obrigatório.',
            'location.state.required' => 'O estado é obrigatório.',
            'location.city.required' => 'A cidade é obrigatória.',
            'location.district.required' => 'O bairro é obrigatório.',
            'location.street.required' => 'A rua é obrigatória.',
            'location.address_line.required' => 'O endereço completo é obrigatório.',
            'location.postal_code.required' => 'O CEP é obrigatório.',
            'location.postal_code.regex' => 'O CEP brasileiro deve estar no formato 12345-678.',
            'location.latitude.numeric' => 'A latitude deve ser um valor numérico.',
            'location.latitude.between' => 'A latitude deve estar entre -90 e 90 graus.',
            'location.latitude.regex' => 'Formato de latitude inválido (use até 8 casas decimais).',
            'location.longitude.numeric' => 'A longitude deve ser um valor numérico.',
            'location.longitude.between' => 'A longitude deve estar entre -180 e 180 graus.',
            'location.longitude.regex' => 'Formato de longitude inválido (use até 8 casas decimais).',
            'details.type.required' => 'O tipo de propriedade é obrigatório.',
            'details.type.in' => 'O tipo deve ser: casa, apartamento ou fazenda.',
            'details.size.required' => 'O tamanho da propriedade é obrigatório.',
            'details.size.numeric' => 'O tamanho deve ser um valor numérico.',
            'details.size.min' => 'O tamanho não pode ser negativo.',
            'details.bedrooms.integer' => 'O número de quartos deve ser inteiro.',
            'details.bedrooms.min' => 'O número de quartos não pode ser negativo.',
            'details.suites.integer' => 'O número de suítes deve ser inteiro.',
            'details.suites.min' => 'O número de suítes não pode ser negativo.',
            'details.bathrooms.integer' => 'O número de banheiros deve ser inteiro.',
            'details.bathrooms.min' => 'O número de banheiros não pode ser negativo.',
            'details.garages.integer' => 'O número de garagens deve ser inteiro.',
            'details.garages.min' => 'O número de garagens não pode ser negativo.',
            'details.construction_year.integer' => 'O ano de construção deve ser um número inteiro.',
            'details.construction_year.min' => 'O ano de construção não pode ser anterior a 1800.',
            'details.construction_year.max' => 'O ano de construção não pode ser no futuro.',
            'medias.title.required' => 'Cada mídia deve ter um título.',
            'medias.media_type.required' => 'Cada mídia deve ter um tipo definido.',
            'medias.media_type.in' => 'O tipo de mídia deve ser imagem ou vídeo.',
            'medias.file_path.required' => 'Cada mídia deve ter um caminho de arquivo.',
            'medias.file_type.required' => 'Cada mídia deve ter um tipo de arquivo.',
            'medias.file_size.required' => 'Cada mídia deve ter o tamanho do arquivo especificado.',
            'medias.file_size.integer' => 'O tamanho do arquivo deve ser um número inteiro.',
            'medias.file_size.min' => 'O tamanho do arquivo não pode ser negativo.'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422)
        );
    }
}
