<?php

namespace App\Http\Controllers\Dashboard\Categories;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CreateCategoryController extends Controller
{
    //

    public function create()
    {
        return view('dashboard.categories.create');
    }
    
    public function store(Request $request)
    {
        $rules = [];

        foreach (config('translatable.locales') as $locale)
        {
            $rules += [$locale . '.name' => ['required' => Rule::unique('category_translations', 'name')]];
        }

        $request->validate($rules);

        Category::create($request->all());
        return redirect()->route('categories.index')->with('success', __('site.added_successfully'));
    }
}
