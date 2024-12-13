<?php

namespace App\Http\Controllers\Dashboard\Orders;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class ReadOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $orders = Order::whereHas('client', function ($q) use ($request) {
            return $q->where('name', 'LIKE', '%'.$request->search.'%');
        })->paginate(5);

        return view('dashboard.orders.index', compact('orders'));
    }
}
