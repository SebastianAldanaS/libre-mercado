<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Car;
use App\Models\Product;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
	use HasApiTokens, HasFactory, Notifiable, SoftDeletes;


	protected $fillable = [
		'document_id',
		'name',
		'last_name',
		'email',
		'address',
		'password',
	];

	protected $appends = ['full_name'];


	protected $hidden = [
		'password',
	];

	//Cast
	protected $casts = [
		'created_at' => 'datetime:Y-m-d',
		'updated_at' => 'datetime:Y-m-d',
	];

	//Accessor (get)
	public function getFullNameAttribute($value)
	{
		return "{$this->name} {$this->last_name}";
	}


	//Mutator (create - update)
	public function setPasswordAttribute($value)
	{
		$this->attributes['password'] = bcrypt($value);
	}


	//Productos vendidos por el usuario

	public function SellerProducts()
	{
		return $this->hasMany(Product::class, 'seller_id', 'id');
	}

	// Carritos de compras del usuario
	public function Cars()
	{
		return $this->hasMany(Car::class, 'customer_id', 'id');
	}
}