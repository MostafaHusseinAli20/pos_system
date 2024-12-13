<?php

namespace App\Http\Controllers\Dashboard\Products;

use App\Http\Controllers\Controller;
use App\Models\Product;

class DeleteProductController extends Controller
{
    //
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', __('site.deleted_successfully'));
    }
}
