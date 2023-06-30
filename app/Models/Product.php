<?php

namespace App\Models;

use App\Models\Car;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
	use HasFactory, SoftDeletes;

	protected $table = 'products';

	protected $fillable = [
		'category_id',
		'seller_id',
		'name',
		'description',
		'stock',
		'image',
		'price',
	];

	public function Category()
	{
		return $this->belongsTo(Category::class, 'category_id', 'id');
	}

	public function Seller()
	{
		return $this->belongsTo(User::class, 'seller_id', 'id');
	}

	public function Cars()
	{
		return $this->hasMany(Car::class, 'producto_id', 'id');
	}



}