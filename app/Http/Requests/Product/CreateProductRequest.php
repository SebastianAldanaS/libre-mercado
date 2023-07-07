<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
	public function authorize(): bool
	{
		return true;
	}

	public function rules(): array
	{
		return [
			'name' => ['required', 'string'],
			'description' => ['required', 'string'],
			'stock' => ['required', 'numeric'],
			'price' => ['required', 'numeric'],
			'seller_id' => ['numeric'],
			'category_id' => ['required', 'numeric'],
		];
	}


	public function messages()
	{
		return [
			'name.required' => 'El nombre es requerido.',
			'name.string' => 'El nombre no es válido.',
			'description.required' => 'La descripción es requerida.',
			'description.string' => 'La descripción no es válida.',
			'stock.required' => 'El stock es requerido.',
			'stock.numeric' => 'El stock debe ser numérico.',
			'price.required' => 'El precio es requerido.',
			'price.numeric' => 'El precio debe ser numérico.',
			'seller_id.numeric' => 'El ID del vendedor no es válido.',
			'category_id.required' => 'El ID de la categoría es requerido.',
			'category_id.numeric' => 'La categoria es obligatoria.',
		];
	}
}