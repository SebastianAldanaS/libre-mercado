<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
	//GetAllCategories

	public function getAllCategories()
	{
		$categories = Category::all();
		return response()->json(['categories' => $categories], 200);
	}

	public function getAllCategoriesDataTable()
	{
		$categories = Category::all();

		return DataTables::of($categories)
			->addColumn('action', function ($row) {
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

	public function getACategory(Category $category)
	{
		return response()->json(['category' => $category], 200);
	}


	public function saveCategory(Request $request)
	{
		$category = new Category();
		$category->name = $request->input('name');
		$category->save();

		return response()->json(['message' => 'Categoría creada correctamente'], 201);
	}

	public function showCategories()
	{
		return view('products.category');
	}

	public function createCategory(Request $request)
	{
		$category = new Category();
		$category->name = $request->input('name');
		$category->save();

		return response()->json(['message' => 'Categoría creada correctamente'], 201);
	}

	public function deleteACategory(Category $category)
	{
		$category->delete();
		return response()->json([], 204);
	}

	public function updateCategory(Request $request, Category $category)
	{
		$category->name = $request->input('name');
		$category->save();

		return response()->json(['message' => 'Categoría actualizada correctamente'], 200);
	}


	public function showallCategories()
	{
		return view('categories.index');
	}

}