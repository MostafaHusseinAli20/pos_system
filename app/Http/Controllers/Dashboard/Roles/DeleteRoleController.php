<?php

namespace App\Http\Controllers\Dashboard\Roles;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DeleteRoleController extends Controller
{
    public function destroy($id)
    {
        DB::table("roles")->where('id', $id)->delete();
        return redirect()->route('roles.index')->with('success', __('site.deleted_successfully'));
    }
}
