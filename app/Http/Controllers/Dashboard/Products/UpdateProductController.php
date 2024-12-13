<?php

namespace App\Http\Controllers\Dashboard\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UpdateProductController extends Controller
{
    //

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $categories = Category::all();
        $product = Product::find($id);
        return view('dashboard.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $rules = [
            'category_id' =>'required',
        ];

        foreach(config('translatable.locales') as $locale)
        {
            $rules += [$locale . '.name' => ['required' , Rule::unique('product_translations', 'name')->ignore($product->id, 'product_id')]];
            $rules += [$locale . '.description' => 'required'];
        }

        $rules += [
            'purchase_price' =>'required',
            'sale_price' =>'required',
            'stock' => 'required',
        ];

        $product->update($request->all());
        return redirect()->route('products.index')->with('success', __('site.updated_successfully'));
    }
}
