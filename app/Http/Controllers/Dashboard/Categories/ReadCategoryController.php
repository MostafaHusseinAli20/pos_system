<?php

namespace App\Http\Controllers\Dashboard\Categories;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class ReadCategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::when($request->search, function ($q) use ($request) {
            return $q->whereTranslationLike('name', '%'.$request->search.'%');
        })->paginate(5);

        return view('dashboard.categories.index', compact('categories'));
    }
}
