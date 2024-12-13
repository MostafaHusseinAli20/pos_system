<?php

namespace App\Http\Controllers\Dashboard\Clients;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ReadClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $clients = Client::when($request->search, function ($q) use ($request) {
            return $q->where('name','LIKE', '%'.$request->search.'%')
                ->orWhere('phone', 'LIKE', '%'.$request->search.'%')
                ->orWhere('address', 'LIKE', '%'.$request->search);
        })->paginate(5);

        return view('dashboard.clients.index', compact('clients'));
    }
}
