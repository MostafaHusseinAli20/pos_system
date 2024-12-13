<?php

namespace App\Http\Controllers\Dashboard\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainClientController extends Controller
{
   protected $readClinet;
   protected $createClient;
   protected $updateClient;
   protected $deleteClient;

   public function __construct(
    ReadClientController $readClinet, 
    CreateClientController $createClient, 
    UpdateClientController $updateClient, 
    DeleteClientController $deleteClient
    )
    {
    $this->middleware(['permission:create_client'])->only(['create', 'store']);
    $this->middleware(['permission:read_client'])->only('index');
    $this->middleware(['permission:update_client'])->only(['edit', 'update']);
    $this->middleware(['permission:delete_client'])->only('destroy');
    $this->readClinet = $readClinet;
    $this->createClient = $createClient;
    $this->updateClient = $updateClient;
    $this->deleteClient = $deleteClient;
   }

   public function index(Request $request)
   {
        return $this->readClinet->index($request);
   }
    public function create()
    {
        return $this->createClient->create();
    }
    public function store(Request $request)
    {
        return $this->createClient->store($request);
    }
    public function edit($id)
    {
        return $this->updateClient->edit($id);
    }
    public function update(Request $request, $id)
    {
        return $this->updateClient->update($request, $id);
    }
    public function destroy($id)
    {
        return $this->deleteClient->destroy($id);
    }
}
