<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

// Usuarios
Route::group(['prefix' => 'Users', 'controller' => UserController::class], function () {

	Route::get('/GetAllUsers', 'getAllUsers'); //	mostrar todos los usuarios
	Route::get('/GetAnUser/{user}', 'getAnUser'); // mostrar un usuario por id

	Route::get('/GetAllCarsByUser/{user}', 'getAllCarsByUser'); // mostrar un usuario por id


	Route::post('/CreateUser', 'createUser'); //crear usuario

	Route::put('/UpdateUser/{user}', 'updateUser'); //actulizar usuario

	Route::delete('/DeleteUser/{user}', 'deleteUser'); //eliminar usuario

});

// Productos
Route::group(['prefix' => 'Products', 'controller' => ProductController::class], function () {

	Route::get('/GetAllProducts', 'getAllProducts'); //crear producto

	Route::post('/CreateProduct', 'createProduct'); //crear producto

});

// Carritos
Route::group(['prefix' => 'Cars', 'controller' => CarController::class], function () {

	Route::post('/CreateCar', 'createCar'); //crear carrito

});