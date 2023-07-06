<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\User;
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

	public function getAllCarsByUser($userId)
	{
		$user = User::find($userId);
		if (!$user) {
			return response()->json(['error' => 'Usuario no encontrado'], 404);
		}

		$customerCars = $user->load('Cars.product.Category', 'Cars.product.Seller')->Cars;
		return response()->json(['customer_cars' => $customerCars], 200);
	}


	public function showCar()
	{
		return view('carshop.index');
	}

	public function deleteCarProduct($carId)
	{
		$car = Car::find($carId);
		if (!$car) {
			return response()->json(['error' => 'Carrito no encontrado'], 404);
		}

		$car->delete();
		return response()->json(['message' => 'Carrito eliminado correctamente'], 200);
	}

}