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

});

Route::get('/crear', function () {
	return view('users.crear');
});



Route::get('/', [ProductController::class, 'showHomeWithProducts'])->name('home');

Route::get('/register', [UserController::class, 'showRegister'])->name('registro');

// Usuarios
Route::group(['prefix' => 'Users', 'controller' => UserController::class], function () {

	Route::post('/SaveUser', 'saveUser'); //crear usuario

	Route::group(
		[
			'middleware' => ['auth', 'role:admin']
		],
		function () {

			Route::get('/GetAllCarsByUser/{user}', 'getAllCarsByUser'); // buscar si un usuario tiene carrito
			Route::get('/', 'showAllUsers')->name('users');
			Route::post('/CreateUser', 'showCreateUser');
			Route::get('/GetAllUsers', 'getAllUsers'); //	mostrar todos los usuarios
			Route::get('/GetAnUser/{user}', 'getAnUser'); // mostrar un usuario por id
			Route::put('/UpdateUser/{user}', 'updateUser'); //actulizar usuario
			Route::delete('/DeleteAUser/{user}', 'deleteUser'); //eliminar usuario
		}
	);

});


// Productos
Route::group(['prefix' => 'Products', 'middleware' => ['auth', 'role:admin'], 'controller' => ProductController::class], function () {
	Route::get('/', 'showProducts')->name('products');
	Route::get('/GetAllProducts', 'getAllProducts');

	Route::get('/GetAllProductsDataTable', 'getAllProductsForDataTable');

	Route::get('/GetAProduct/{product}', 'getAProduct');
	Route::get('/GetProductsByCategory/{category}', 'getProductsByCategory');
	Route::get('/GetAProduct/{product}', 'getAProduct');

	Route::post('/CreateProduct', 'createProduct'); //crear producto
	Route::post('/SaveProduct', 'saveProduct'); //guardar producto
	Route::post('/UpdateProduct/{product}', 'updateProduct'); //actualizar producto
	Route::delete('/DeleteAProduct/{product}', 'deleteAProduct'); //Borrar producto

});

// Producto
Route::group(['prefix' => 'Product', 'controller' => ProductController::class], function () {
	Route::get('/{product}', 'showProduct')->name('product');

});


// Categorias
Route::group(['prefix' => 'Categories', 'controller' => CategoryController::class], function () {

	Route::get('/', 'showCategories')->name('categories');
	Route::get('/List', 'showallCategories')->name('listcategories');
	Route::post('/CreateCategory', 'createCategory');

	Route::get('/GetAllCategoriesDataTable', 'getAllCategoriesDataTable');
	Route::get('/GetAllCategories', 'getAllCategories');

	Route::get('/GetACategory/{category}', 'getACategory');

	Route::post('/SaveCategory', 'saveCategory');
	Route::post('/UpdateCategory/{category}', 'updateCategory');
	Route::delete('/DeleteCategory/{category}', 'deleteACategory');

});

// Carritos
Route::group(['prefix' => 'Cars', 'controller' => CarController::class], function () {

	Route::post('/CreateCar', 'createCar'); //crear carrito
	Route::get('/', 'showCar')->name('carrito');
	Route::get('/GetAllCarsByUser/{user}', 'getAllCarsByUser');
	Route::delete('/DeleteCarProduct/{carId}', 'deleteCarProduct');
	Route::put('/UpdateCarQuantity/{carId}', 'updateCarQuantity');

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