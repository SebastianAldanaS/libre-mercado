<?php

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\ServiceProvider;

return [



	'name' => env('APP_NAME', 'Laravel'),


	'env' => env('APP_ENV', 'production'),


	'debug' => (bool) env('APP_DEBUG', false),




	'url' => env('APP_URL', 'http://localhost'),

	'asset_url' => env('ASSET_URL'),


	'timezone' => 'UTC',



	'locale' => 'en',


	'fallback_locale' => 'en',



	'faker_locale' => 'en_US',


	'key' => env('APP_KEY'),

	'cipher' => 'AES-256-CBC',



	'maintenance' => [
		'driver' => 'file',
		// 'store'  => 'redis',
	],



	'providers' => ServiceProvider::defaultProviders()->merge([
			/*
			 * Package Service Providers...
			 */

			/*
			 * Application Service Providers...
			 */
		App\Providers\AppServiceProvider::class,
		App\Providers\AuthServiceProvider::class,
			// App\Providers\BroadcastServiceProvider::class,
		App\Providers\EventServiceProvider::class,
		App\Providers\RouteServiceProvider::class,
		Spatie\Permission\PermissionServiceProvider::class,

	])->toArray(),



	'aliases' => Facade::defaultAliases()->merge([
		// 'Example' => App\Facades\Example::class,
	])->toArray(),

];