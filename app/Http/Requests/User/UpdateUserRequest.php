<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
	public function authorize(): bool
	{
		return true;
	}

	public function rules()
	{
		return [
			'name' => ['required', 'string'],
			'last_name' => ['required', 'string'],
			'document_id' => ['required', 'numeric', "unique:users,document_id,{$this->user->id}"],
			'email' => ['required', 'email', "unique:users,email,{$this->user->id}"],
			'address' => ['required', 'string'],
			'password' => ['nullable', 'string', 'min:8', 'confirmed'],
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
			'document_id.numeric' => 'El id no es un numero.',
			'document_id.unique' => 'El id ya existe.',

			'email.required' => 'El email es requerido.',
			'email.email' => 'El email no es valido.',
			'email.unique' => 'El email ya existe.',

			'password.string' => 'La contraseña debe ser valida.',
			'password.min' => 'La contraseña es muy corta (min8).',
			'password.confirmed' => 'La contraseña no coincide',
		];
	}
}