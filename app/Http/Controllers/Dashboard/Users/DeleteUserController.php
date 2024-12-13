<?php

namespace App\Http\Controllers\Dashboard\Users;

use App\Http\Controllers\Controller;
use App\Models\User;

class DeleteUserController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')->with('success', __('site.deleted_successfully'));
    }
}
