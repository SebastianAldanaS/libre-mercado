<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeed extends Seeder
{

	public function run(): void
	{
		DB::table('categories')->insert([
			'name' => 'Electrónica',
		]);

		DB::table('categories')->insert([
			'name' => 'Deportes',
		]);

		DB::table('categories')->insert([
			'name' => 'Belleza',
		]);

		DB::table('categories')->insert([
			'name' => 'Decoración',
		]);

		DB::table('categories')->insert([
			'name' => 'Libros',
		]);

		DB::table('categories')->insert([
			'name' => 'Salud',
		]);

		DB::table('categories')->insert([
			'name' => 'Automotriz',
		]);

		DB::table('categories')->insert([
			'name' => 'Arte',
		]);

		DB::table('categories')->insert([
			'name' => 'Videojuegos',
		]);

		DB::table('categories')->insert([
			'name' => 'Supermercado',
		]);


	}
}