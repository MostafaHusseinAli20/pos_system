<?php

namespace App\Http\Controllers\Dashboard\Clients\Orders;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:create_order'])->only(['create', 'store']);
        $this->middleware(['permission:update_order'])->only(['edit', 'update']);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $categories = Category::with('products')->get();
        $client = Client::find($id);
        $orders = $client->orders()->with('products')->paginate(5);
        return view('dashboard.clients.orders.create', compact('client','categories','orders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Client $client)
    {
        $request->validate([
            'products' => 'required|array',
        ]);

        $this->attach_order($request, $client);

        return redirect()->route('orders.index')
        ->with('success', __('site.add_order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client, Order $order)
    {
        $categories = Category::with('products')->get();
        $orders = $client->orders()->with('products')->paginate(5);
        return view('dashboard.clients.orders.edit', compact('categories', 'orders', 'client','order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client, Order $order)
    {
        $request->validate([
            'products' => 'required|array',
        ]);

        $this->detach_order($order);
        $this->attach_order($request, $client);

        return redirect()->route('orders.index')
        ->with('success', __('site.edit_order'));
    }

    private function attach_order($request, $client)
    {
        $order = $client->orders()->create([]);
        $order->products()->attach($request->products);
        $total_price = 0;

        foreach ($request->products as $id => $quantity) {

            $product = Product::FindOrFail($id);
            $total_price += $product->sale_price * $quantity['quantity'];

            $product->update([
                'stock' => $product->stock - $quantity['quantity']
            ]);
        }

        $order->update([
            'total_price' => $total_price
        ]);

    }

    private function detach_order($order)
    {
        foreach ($order->products as $product) {

            $product->update([
                'stock' => $product->stock + $product->pivot->quantity
            ]);
        }
        $order->delete();
    }
}
