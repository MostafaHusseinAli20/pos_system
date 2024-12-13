<?php

namespace App\Http\Controllers\Dashboard\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainUserController extends Controller
{
    protected $createUser;
    protected $readUser;
    protected $updateUser;
    protected $deleteUser;
    public function __construct(
        CreateUserController $createUser,
        ReadUserController $readUser,
        UpdateUserController $updateUser,
        DeleteUserController $deleteUser
    )
    {
        $this->middleware(['permission:create_user'])->only(['create', 'store']);
        $this->middleware(['permission:read_user'])->only('index');
        $this->middleware(['permission:update_user'])->only(['edit', 'update']);
        $this->middleware(['permission:delete_user'])->only('destroy');
        $this->createUser = $createUser;
        $this->readUser = $readUser;
        $this->updateUser = $updateUser;
        $this->deleteUser = $deleteUser;
    }

    public function index(Request $request)
    {
        return $this->readUser->index($request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->createUser->create();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->createUser->store($request);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->updateUser->edit($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        return $this->updateUser->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
       $this->deleteUser->destroy($id);
    }
}
