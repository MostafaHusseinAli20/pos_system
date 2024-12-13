<?php

namespace App\Http\Controllers\Dashboard\Clients;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class UpdateClientController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $client = Client::find($id);
        return view('dashboard.clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'phone.0' => 'required',
            'phone' => 'required|array|min:1',
            'address' => 'required',
        ]);

        Client::find($id)->update($request->all());
        return redirect()->route('clients.index')->with('success', __('site.updated_successfully'));
    }
}
