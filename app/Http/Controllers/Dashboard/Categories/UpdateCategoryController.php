<?php

namespace App\Http\Controllers\Dashboard\Categories;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateCategoryController extends Controller
{
    //

    public function edit($id)
    {
        $category = Category::find($id);
        return view('dashboard.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $rules = [];

        $category = Category::find($id);

        foreach (config('translatable.locales') as $locale)
        {
            $rules += [$locale . '.name' => ['required', Rule::unique('category_translations', 'name')->ignore($category->id, 'category_id')]];
        }

        $request->validate($rules);

        $category->update($request->all());
        return redirect()->route('categories.index')->with('success', __('site.updated_successfully'));
    }
}
