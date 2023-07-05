<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

// Usuarios
Route::group(['prefix' => 'Users', 'middleware' => ['auth', 'role:admin'], 'controller' => UserController::class], function () {

	Route::get('/GetAllUsers', 'getAllUsers')->name('users'); //	mostrar todos los usuarios
	Route::get('/GetAnUser/{user}', 'getAnUser'); // mostrar un usuario por id
	Route::get('/GetAllCarsByUser/{user}', 'getAllCarsByUser'); // buscar si un usuario tiene carrito

	Route::post('/CreateUser', 'createUser'); //crear usuario
	Route::post('/SaveUser', 'saveUser'); //crear usuario

	Route::put('/UpdateUser/{user}', 'updateUser'); //actulizar usuario
	Route::delete('/DeleteUser/{user}', 'deleteUser'); //eliminar usuario
});

// Productos
Route::group(['prefix' => 'Products', 'controller' => ProductController::class], function () {

	Route::get('/', 'showProducts')->name('products');
	Route::get('/GetAllProducts', 'getAllProducts')->name('products');
	Route::get('/GetProductsByCategory/{category}', 'getProductsByCategory');
	Route::get('/GetAProduct/{product}', 'getAProduct');


	Route::post('/CreateProduct', 'createProduct'); //crear producto
	Route::post('/SaveProduct', 'saveProduct'); //guardar producto
	Route::post('/UpdateProduct', 'updateProduct'); //actualizar producto
});


// Categories
Route::group(['prefix' => 'Categories', 'controller' => CategoryController::class], function () {

	Route::get('/GetAllCategories', 'getAllCategories')->name('categories');

});

// Carritos
Route::group(['prefix' => 'Cars', 'controller' => CarController::class], function () {

	Route::post('/CreateCar', 'createCar'); //crear carrito

});