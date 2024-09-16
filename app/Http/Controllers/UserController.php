<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
		try {
			DB::beginTransaction();
			$user = new User($request->all());
			$user->save();
			$user->assignRole($request->role);
			DB::commit();
			if ($request->ajax())
				return response()->json(['user' => $user], 201);
		} catch (\Throwable $th) {
			DB::rollBack();
			throw $th;
		}
	}



	public function updateUser(User $user, UpdateUserRequest $request)
	{

		try {
			DB::beginTransaction();
			$allRequest = $request->all();
			if (isset($allRequest['password'])) {
				if (!$allRequest['password'])
					unset($allRequest['password']);
			}
			$user->update($request->all());
			$user->syncRoles([$request->role]);
			DB::commit();
			if ($request->ajax())
				return response()->json(['user' => $user->refresh()], 201);
			return back()->with('success', 'Usuario editado');
		} catch (\Throwable $th) {
			DB::rollBack();
			throw $th;
		}
	}

	public function deleteUser(User $user)
	{
		$user->delete();
		return response()->json([], 204);

	}
}