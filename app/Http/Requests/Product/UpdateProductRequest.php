<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
			'stock.numeric' => 'El stock debe ser un número.',
			'price.required' => 'El precio es requerido.',
			'price.numeric' => 'El precio debe ser un número.',
			'seller_id.numeric' => 'El ID del vendedor debe ser un número.',
			'category_id.required' => 'El ID de la categoría es requerido.',
			'category_id.numeric' => 'El ID de la categoría debe ser un número.',
		];
	}
}