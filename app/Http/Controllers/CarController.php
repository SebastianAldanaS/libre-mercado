<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
	public function createCar( /*User $customer, Product $product,*/Request $request)
	{
		$car = new Car($request->all());

		//$car->customer_id = $customer;
		//$car->product_id = $product;
		$car->save();
		return response()->json(['car' => $car], 201);
	}
}