<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;


class ProductFactory extends Factory
{

	protected $model = Product::class;


	public function definition(): array
	{
		return [
			'category_id' => $this->faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]),
			'seller_id' => $this->faker->randomElement([2, 3, 4]),
			'name' => $this->faker->name(),
			'description' => $this->faker->paragraph(),
			'stock' => $this->faker->randomDigit(),
			'price' => $this->faker->randomFloat(2, 0, 100),
		];
	}
}