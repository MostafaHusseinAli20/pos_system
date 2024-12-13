<?php

namespace App\Http\Controllers\Dashboard\Roles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class ReadRoleController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = Role::where('name','!=', 'super_admin')->where(function ($q) use ($request) {
            return $q->when($request->search, function ($query) use ($request) {
                return $query->where('name', 'LIKE', '%'.$request->search.'%');
            });
        })->paginate(5);

        return view('dashboard.roles.index', compact('roles'));
    }
}
