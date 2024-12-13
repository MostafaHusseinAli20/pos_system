<?php

namespace App\Http\Controllers\Dashboard\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class ReadProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $products = Product::when($request->search, function ($q) use ($request) 
        {
            return $q->whereTranslationLike('name', '%'.$request->search.'%');
        })->when($request->category_id, function ($q) use ($request)
        {
            return $q->where('category_id', $request->category_id);
        })->paginate(5);
        return view('dashboard.products.index', compact('products','categories'));
    }
}
