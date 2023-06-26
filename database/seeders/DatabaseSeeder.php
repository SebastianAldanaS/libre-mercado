<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use App\Models\User;
use Database\Seeders\UserSeed;
use Illuminate\Database\Seeder;
use Database\Seeders\CategorySeed;

class DatabaseSeeder extends Seeder
{

	public function run(): void
	{
		$this->call([
			UserSeed::class,
			CategorySeed::class,
		]);

		User::factory(20)->create();
		Product::factory(2)->create();


		// \App\Models\User::factory()->create([
		//     'name' => 'Test User',
		//     'email' => 'test@example.com',
		// ]);
	}
}