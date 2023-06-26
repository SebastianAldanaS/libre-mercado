<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Car extends Model
{
	use HasFactory, SoftDeletes;

	protected $table = 'cars';

	protected $fillable = [
		'customer_id',
		'product_id',
		'product_price',
		'quantity',
	];

	public function User()
	{
		return $this->belongsTo(User::class, 'customer_id', 'id');
	}

	public function product()
	{
		return $this->belongsTo(Product::class, 'product_id', 'id');
	}


}