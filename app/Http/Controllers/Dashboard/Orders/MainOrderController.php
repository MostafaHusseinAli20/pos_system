<?php

namespace App\Http\Controllers\Dashboard\Orders;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class MainOrderController extends Controller
{
    private $readOrder;
    private $deleteOrder;
    public function __construct(
        ReadOrderController $readOrder,
        DeleteOrderController $deleteOrder
    ) 
    {
        $this->middleware(['permission:read_order'])->only('index');
        $this->middleware(['permission:show_order'])->only('products');
        $this->middleware(['permission:delete_order'])->only('destroy');
        $this->readOrder = $readOrder;
        $this->deleteOrder = $deleteOrder;
    }

    public function index(Request $request)
    {
        return $this->readOrder->index($request);
    }

    public function destroy(Order $order)
    {
        return $this->deleteOrder->destroy($order);
    }

    public function products(Order $order)
    {
        $products = $order->products;
        return view('dashboard.orders._products', compact('order', 'products'));
    }
}
