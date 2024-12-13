<?php

namespace App\Http\Controllers\Dashboard\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
// use League\Glide\Laravel\Facades\GlideImage;

class CreateUserController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('dashboard.users.create', compact('roles'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users',
            'image' => 'image|mimes:png,jpg,jpeg',
            'password' => 'required|min:6',
            'roles_name' => 'required|array'
        ]);

        $request_data = $request->except(['password', 'image']);
        $request_data['password'] = bcrypt($request->password);

        $user = User::create($request_data);
        $user->assignRole($request->input('roles_name'));
        return redirect()->route('users.index')->with('success', __('site.added_successfully'));
    }
}
