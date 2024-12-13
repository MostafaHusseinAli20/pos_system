<?php

namespace App\Http\Controllers\Dashboard\Roles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateRoleController extends Controller
{
    public function create()
    {
        $permissions = Permission::get();
        return view('dashboard.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));
        return redirect()->route('roles.index')->with('success', __('site.added_successfully'));
    }
}
