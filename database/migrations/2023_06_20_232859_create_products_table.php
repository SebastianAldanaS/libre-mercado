<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up(): void
	{
		Schema::create('products', function (Blueprint $table) {
			$table->id();
			$table->bigInteger('category_id')->unsigned();
			$table->bigInteger('seller_id')->unsigned();
			$table->string('name');
			$table->text('description');
			$table->integer('stock')->unsigned();
			$table->string('image')->nullable();
			$table->timestamps();
			$table->softDeletes(); // fecha eliminacion
			$table->float('price')->unsigned();

			$table->foreign('category_id')
				->references('id')
				->on('categories')
				->onDelete('cascade');

			$table->foreign('seller_id')
				->references('id')
				->on('users')
				->onDelete('cascade');
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('products');
	}
};