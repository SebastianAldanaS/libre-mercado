<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
	//GetAllCategories

	public function getAllCategories()
	{
		$categories = Category::get();
		return response()->json(['categories' => $categories], 200);
	}
}