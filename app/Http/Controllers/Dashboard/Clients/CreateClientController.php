<?php

namespace App\Http\Controllers\Dashboard\Clients;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class CreateClientController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone.0' => 'required',
            'phone' => 'required|array|min:1',
            'address' => 'required',
        ]);

        Client::create($request->all());
        return redirect()->route('clients.index')->with('success', __('site.added_successfully'));
    }
}
