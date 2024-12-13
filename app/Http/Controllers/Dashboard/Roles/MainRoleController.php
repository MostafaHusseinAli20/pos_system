<?php

namespace App\Http\Controllers\Dashboard\Roles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainRoleController extends Controller
{
    protected $createRole;
    protected $readRole;
    protected $updateRole;
    protected $deleteRole;
    public function __construct(
        CreateRoleController $createRole,
        ReadRoleController $readRole,
        UpdateRoleController $updateRole,
        DeleteRoleController $deleteRole,
    )
    {
        $this->middleware(['permission:create_role'])->only(['create', 'store']);
        $this->middleware(['permission:read_role'])->only('index');
        $this->middleware(['permission:update_role'])->only(['edit', 'update']);
        $this->middleware(['permission:delete_role'])->only('destroy');
        $this->createRole = $createRole;
        $this->readRole = $readRole;
        $this->updateRole = $updateRole;
        $this->deleteRole = $deleteRole;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->readRole->index($request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->createRole->create();
    }

    public function store(Request $request)
    {
        return $this->createRole->store($request);
    }

    public function edit($id)
    {
        return $this->updateRole->edit($id);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * */
    public function update(Request $request, $id)
    {
        return $this->updateRole->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * */
    public function destroy($id)
    {
        return $this->deleteRole->destroy($id);
    }
}
