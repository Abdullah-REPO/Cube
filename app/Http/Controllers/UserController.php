<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Permission;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Traits\SaveImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use SaveImageTrait;

    public function index(User $user)
    {
        $this->authorize('read-users', $user);
        $users = User::all()->except(['id', Auth::id()]);
        return view('pages.users.index', ['users' => $users]);
    }

    public function create(User $user)
    {
        $this->authorize('write-users', $user);

        return view('pages.users.create');
    }

    public function store(StoreUserRequest $request, User $user)
    {
        $this->authorize('write-users', $user);

        if ($request->hasFile('image')) {
            $request->merge(['avatar' => $this->saveImage($request, 'images/avatars')]);
        }

        $request->merge(['password' => Hash::make($request->password)]);
        $user = User::create($request->all());

        foreach ($request->modules as $module) {
            $permission = Permission::firstOrCreate(['module' => $module]);
            $user->permissions()->attach($permission->id, ['access' => $request->access]);
        }
        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function show(User $user)
    {
        $permissions = $user->permissions;
        $access = $permissions[0]->pivot->access;
        foreach ($permissions as $permission) {
            $modules[] = $permission->module;
        }
        return view('pages.users.show', ['user' => $user, 'modules' => $modules, 'access' => $access]);
    }

    public function edit(User $user)
    {
        $this->authorize('write-users', $user);

        $permissions = $user->permissions;
        $access = $permissions[0]->pivot->access;
        foreach ($permissions as $permission) {
            $modules[] = $permission->module;
        }
        return view('pages.users.edit', ['user' => $user, 'modules' => $modules, 'access' => $access]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('write-users', $user);

        if ($request->hasFile('image')) {
            if ($user->avatar != "user-default.png")
                Storage::disk('avatars')->delete($user->avatar);
            $request->merge(['avatar' => $this->saveImage($request, 'images/avatars')]);
        }

        $request->merge(['password' => Hash::make($request->password)]);
        $user->update($request->all());

        foreach ($request->modules as $module) {
            $permission = Permission::firstOrCreate(['module' => $module]);
            $permissionIDs[] = $permission->id;
        }
        $user->permissions()->syncWithPivotValues($permissionIDs, ['access' => $request->access]);
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(Request $request)
    {
        $this->authorize('write-users');
        $user = User::find($request->id);
        $user->delete();
        return redirect()->route('users.index');
    }
    public function multipleDelete(Request $request)
    {
        $this->authorize('write-users');

        dd($request->ids);
        $users = User::whereIn('id', $request->ids)->get();
        foreach ($users as $user) {
            $user->delete();
        }
    }
}
