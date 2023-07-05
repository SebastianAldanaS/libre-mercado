<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;

class UserController extends Controller
{

	public function showAllUsers()
	{
		$users = $this->getAllUsers()->original['users'];
		return view('users.index', compact('users'));
	}



	public function showRegister()
	{
		return view('register.index');
	}

	public function showCreateUser()
	{
		$roles = $this->getAllRoles()->original['roles'];
		return view('users.create-user', compact('roles'));
	}

	public function showEditUser(User $user)
	{
		$roles = $this->getAllRoles()->original['roles'];
		$user->load('roles');
		return view('users.edit-user', compact('user', 'roles'));
	}

	public function getAllUsers()
	{
		$users = User::get();
		return response()->json(['users' => $users], 200);
	}


	public function getAllRoles()
	{
		$roles = Role::all()->pluck('name');
		return response()->json(['roles' => $roles], 200);
	}



	public function getAllCarsByUser(User $user)
	{
		$customerCars = $user->load('Cars.product.Category', 'Cars.product.Seller')->Cars;
		return response()->json(['customer_cars' => $customerCars], 200);
	}



	public function getAnUser(User $user)
	{
		return response()->json(['user' => $user], 200);
	}

	public function createUser(CreateUserRequest $request)
	{
		$user = new User($request->validated());
		$user = new User($request->all());
		$user->save();
		return response()->json(['request' => $user], 201);

	}

	public function saveUser(CreateUserRequest $request)
	{
		$user = new User($request->all());
		$user->save();
		return response()->json(['user' => $user], 200);
	}


	public function updateUser(User $user, UpdateUserRequest $request)
	{
		$user->update($request->all());
		return response()->json(['user' => $user->refresh()], 201);

	}

	public function deleteUser(User $user)
	{
		$user->delete();
		return response()->json([], 204);

	}
}