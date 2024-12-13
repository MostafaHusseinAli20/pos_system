<?php

namespace App\Http\Controllers\Dashboard\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ReadUserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::role('admin')->where(function($q) use ($request) {
            return $q->when($request->search, function($query) use($request) {
                return $query->where('first_name', 'LIKE', '%'.$request->search.'%')
                ->orWhere('last_name', 'LIKE', '%'.$request->search.'%');
            });
        })->paginate(5);

        return view('dashboard.users.index', compact('users'));
    }
}
