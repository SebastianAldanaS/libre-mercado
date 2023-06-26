<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;


class UserFactory extends Factory
{

	protected $model = User::class;


	public function definition(): array
	{
		return [
			'document_id' => $this->faker->randomNumber(9, true),
			'name' => $this->faker->name(),
			'last_name' => $this->faker->name(),
			'email' => $this->faker->unique()->safeEmail(),
			'address' => $this->faker->address(),
			'password' => bcrypt(123456789),
		];
	}

}