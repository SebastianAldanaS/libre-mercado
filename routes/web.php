<?php

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ConfirmPasswordController;




Route::get('/', [ProductController::class, 'showHomeWithProducts'])->name('home');


Route::group(['prefix' => 'Users', 'controller' => UserController::class], function () {
	Route::get('/', 'showAllUsers')->name('users');
	Route::get('/CreateUser', 'showCreateUser')->name('user.create');

});


// Productos
Route::group(['prefix' => 'Products', 'controller' => ProductController::class], function () {
	Route::get('/', 'showProducts')->name('products');
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