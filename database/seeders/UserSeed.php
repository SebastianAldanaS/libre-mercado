<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeed extends Seeder
{

	public function run(): void
	{
		DB::table('users')->insert([
			'document_id' => '1112787575',
			'name' => 'Sebastian',
			'last_name' => 'Aldana',
			'email' => 'sebas.a.s1313@hotmail.com',
			'address' => 'calle 12 35 87',
			'password' => bcrypt(123456789),
		]);
	}
}