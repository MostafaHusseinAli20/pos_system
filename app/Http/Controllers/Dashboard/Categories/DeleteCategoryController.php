<?php

namespace App\Http\Controllers\Dashboard\Categories;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class DeleteCategoryController extends Controller
{
    //

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        return redirect()->route('categories.index')->with('success', __('site.deleted_successfully'));
    }
}
