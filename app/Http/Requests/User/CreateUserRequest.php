<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{

	public function authorize(): bool
	{
		return true;
	}

	public function rules(): array
	{
		return [
			'name' => ['required', 'string'],
			'last_name' => ['required', 'string'],
			'document_id' => ['required', 'string', 'unique:users,document_id'],
			'email' => ['required', 'email', 'unique:users,email'],
			'address' => ['required', 'string'],
			'password' => ['required', 'string', 'min:8', 'confirmed'],
			'role' => ['required'],

		];
	}

	public function messages()
	{
		return [
			'name.required' => 'El nombre es requerido.',
			'name.string' => 'El nombre no es valido.',

			'last_name.required' => 'El apellido es requerido.',
			'last_name.string' => 'El apellido no es valido.',

			'document_id.required' => 'El id es requerido.',
			'document_id.string' => 'El id no es un numero.',
			'document_id.unique' => 'El id ya existe.',

			'email.required' => 'El email es requerido.',
			'email.email' => 'El email no es valido.',
			'email.unique' => 'El email ya existe.',

			'address.required' => 'La direccion es requerida.',
			'address.string' => 'La direccion no es valida.',

			'password.required' => 'La contraseña es requerida.',
			'password.string' => 'La contraseña debe ser valida.',
			'password.min' => 'La contraseña es muy corta (min8).',
			'password.confirmed' => 'La contraseña no coincide',

			'role.required' => 'El Rol es requerido.',
		];
	}
}