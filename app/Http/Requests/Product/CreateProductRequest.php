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
			'price' => ['required', 'decimal:2']

		];
	}


	public function messages()
	{
		return [
			'name.required' => 'El nombre es requerido.',
			'name.string' => 'El nombre no es valido.',

			'description.required' => 'Una descripcion es requerida',
			'description.string' => 'La descripcion no es valida',

			'stock.required' => 'El stock es requerido',
			'stock.numeric' => 'El stock no es valido',

			'price.required' => 'El precio es requerido',
			'price.decimal' => 'El precio no es valido'

		];
	}
}