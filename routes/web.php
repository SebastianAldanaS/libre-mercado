<?php

use App\Models\User;
use App\Models\Product;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ConfirmPasswordController;

Route::get('/test', function () {
	/*$users = User::get();
												 foreach ($users as $user) {
													 if ($user->document_id == 1112787575) {
														 $user->assignRole('admin');

													 } else {

														 $user->assignRole('customer');
													 }
												 }*/
	//Role::create(['name' => 'customer']);
});


Route::get('/', [ProductController::class, 'showHomeWithProducts'])->name('home');

// Usuarios
Route::group(['prefix' => 'Users', 'middleware' => ['auth', 'role:admin'], 'controller' => UserController::class], function () {
	Route::get('/', 'showAllUsers')->name('users');
	Route::get('/CreateUser', 'showCreateUser');

	Route::get('/GetAllUsers', 'getAllUsers'); //	mostrar todos los usuarios
	Route::get('/GetAnUser/{user}', 'getAnUser'); // mostrar un usuario por id
	Route::get('/GetAllCarsByUser/{user}', 'getAllCarsByUser'); // buscar si un usuario tiene carrito

	Route::post('/SaveUser', 'saveUser'); //crear usuario

	Route::put('/UpdateUser/{user}', 'updateUser'); //actulizar usuario
	Route::delete('/DeleteUser/{user}', 'deleteUser'); //eliminar usuario

});


// Productos
Route::group(['prefix' => 'Products', 'middleware' => ['auth', 'role:admin'], 'controller' => ProductController::class], function () {
	Route::get('/', 'showProducts')->name('products');
	Route::get('/GetAllProducts', 'getAllProducts');
	Route::get('/GetAProduct/{product}', 'getAProduct');
	Route::get('/GetProductsByCategory/{category}', 'getProductsByCategory');



	Route::post('/CreateProduct', 'createProduct'); //crear producto
	Route::post('/SaveProduct', 'saveProduct'); //guardar producto
	Route::post('/UpdateProduct/{product}', 'updateProduct'); //actualizar producto
	Route::delete('/DeleteAProduct/{product}', 'deleteAProduct'); //Borrar producto

});


// Categorias
Route::group(['prefix' => 'Categories', 'controller' => CategoryController::class], function () {

	Route::get('/GetAllCategories', 'getAllCategories');

});

// Carritos
Route::group(['prefix' => 'Cars', 'controller' => CarController::class], function () {

	Route::post('/CreateCar', 'createCar'); //crear carrito

});

//------------------------- Auth

Route::group(['controller' => LoginController::class], function () {

	// Login Routes...
	Route::get('login', 'showLoginForm')->name('login');
	Route::post('login', 'login');

	// Logout Routes...
	Route::post('logout', 'logout')->name('logout');

});


Route::group(['controller' => ForgotPasswordController::class], function () {

	// Password Reset Routes...
	Route::get('password/reset', 'showLinkRequestForm')->name('password.request');
	Route::post('password/email', 'sendResetLinkEmail')->name('password.email');

});

Route::group(['controller' => ResetPasswordController::class], function () {

	Route::get('password/reset/{token}', 'showResetForm')->name('password.reset');
	Route::post('password/reset', 'reset')->name('password.update');

});

Route::group(['controller' => ConfirmPasswordController::class], function () {

	// Password Confirmation Routes...
	Route::get('password/confirm', 'showConfirmForm')->name('password.confirm');
	Route::post('password/confirm', 'confirm');

});

Route::group(['controller' => VerificationController::class], function () {

	// Email Verification Routes...
	Route::get('email/verify', 'show')->name('verification.notice');
	Route::get('email/verify/{id}/{hash}', 'verify')->name('verification.verify');
	Route::post('email/resend', 'resend')->name('verification.resend');

});




/*
// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
*/