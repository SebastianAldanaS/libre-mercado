<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

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

	public function getAllProductsForDataTable()
	{
		$products = Product::with('Seller')->with('Category');

		return DataTables::of($products)->addColumn('action', function ($row) {
			return "<a
			href='#'
			onclick='event.preventDefault();'
			data-id='{$row->id}'
			role='edit'
			class='btn btn-warning btn-sm'>Editar</a>
			<a
			href='#'
			onclick='event.preventDefault();'
			data-id='{$row->id}'
			role='delete'
			class='btn btn-danger btn-sm'>Eliminar</a>";
		})
			->rawColumns(['action'])
			->make();
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
		$this->upLoadImages($request, $product);
		$product->save();
		return response()->json(['product' => $product->load('Seller', 'Category')], 201);
	}

	public function updateProduct(Request $request, Product $product)
	{
		$requestAll = $request->all();
		$this->upLoadImages($request, $product);
		$requestAll['image'] = $product->image;
		$product->update($requestAll);
		return response()->json(['product' => $product->refresh()->load('Seller', 'Category')], 201);
	}

	public function deleteAProduct(Product $product)
	{
		$product->delete();
		return response()->json([], 204);
	}

	private function upLoadImages($request, &$product)
	{
		if (!isset($request->image))
			return;
		$random = Str::random(15);
		$image_name = "{$random}.{$request->image->clientExtension()}";
		$request->image->move(storage_path('app/public/images'), $image_name);
		$product->image = $image_name;
	}


}