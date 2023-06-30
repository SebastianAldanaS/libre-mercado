<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

	public function showProducts()
	{
		return view('products.index');
	}

	public function showHomeWithProducts()
	{
		$products = $this->getAllProducts()->original['products'];
		return view('index', compact('products'));
	}

	public function getAllProducts()
	{
		$products = Product::with('Seller')->with('Category')->get();
		return response()->json(['products' => $products], 200);
	}

	public function getAProduct(Product $product)
	{
		$product->load('Seller', 'Category');
		return response()->json(['product' => $product], 200);
	}

	public function createProduct(Request $request)
	{
		$product = new Product($request->all());
		$product->save();
	}


	public function getProductsByCategory($categoryId)
	{
		$products = Product::where('category_id', $categoryId)
			->with('Seller')
			->with('Category')
			->get();

		return response()->json(['products' => $products], 200);
	}

	public function saveProduct(Request $request)
	{
		$product = new Product($request->all());
		$product->save();
		return response()->json(['product' => $product->load('Seller', 'Category')], 201);
	}

	public function updateProduct(Request $request, Product $product)
	{
		$product->update($request->all());
		return response()->json(['product' => $product->refresh()->load('Seller', 'Category')], 201);
	}

	public function deleteAProduct(Product $product)
	{
		$product->delete();
		return response()->json([], 204);
	}


}