<?php

namespace App\Http\Controllers\Dashboard\Clients;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class DeleteClientController extends Controller
{
     /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Client::find($id)->delete();
        return redirect()->route('clients.index')->with('success', __('site.deleted_successfully'));
    }
}
