<?php

namespace App\Http\Controllers\Dashboard\Orders;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class DeleteOrderController extends Controller
{
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        foreach($order->products as $product)
        {
            $product->update([
                'stock' => $product->stock + $product->pivot->quantity
            ]);
        }

        $order->delete();
        return back()->with('success', __('site.delete_order'));
    }
}
