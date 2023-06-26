<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

	public function up(): void
	{
		Schema::create('cars', function (Blueprint $table) {
			$table->id();

			$table->bigInteger('customer_id')->unsigned(); //id del comprador tabla users
			$table->bigInteger('product_id')->unsigned(); //id del producto tabla products (puedo sacar el precio de aqui)
			$table->float('product_price')->unsigned()->default(0); // aqui guardare el precio del articulo para sumarlo
			$table->bigInteger('quantity')->unsigned()->default(0); // cantidad de articulos de un mismo tipo

			$table->timestamps(); // fecha creacion
			$table->softDeletes(); // fecha eliminacion

			$table->foreign('customer_id')
				->references('id')
				->on('users')
				->onDelete('cascade');

			$table->foreign('product_id')
				->references('id')
				->on('products')
				->onDelete('cascade');

			/*$table->foreign('product_price')
																			   ->references('price')
																			   ->on('products')
																			   ->onDelete('cascade');*/


		});
	}

	public function down(): void
	{
		Schema::dropIfExists('cars');
	}
};