<?php

namespace App\Http\Controllers\Dashboard\Categories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainCategoryController extends Controller
{
    protected $readCategory;
    protected $createCategory;
    protected $updateCategory;
    protected $deleteCategory;

    public function __construct(
        ReadCategoryController $readCategory,
        CreateCategoryController $createCategory,
        UpdateCategoryController $updateCategory,
        DeleteCategoryController $deleteCategory,
    )
    {
        $this->middleware(['permission:create_category'])->only(['create', 'store']);
        $this->middleware(['permission:read_category'])->only('index');
        $this->middleware(['permission:update_category'])->only(['edit', 'update']);
        $this->middleware(['permission:delete_category'])->only('destroy');
        $this->readCategory = $readCategory;
        $this->createCategory = $createCategory;
        $this->updateCategory = $updateCategory;
        $this->deleteCategory = $deleteCategory;
    }

    public function index(Request $request)
    {
        return $this->readCategory->index($request);
    }

    public function create()
    {
        return $this->createCategory->create();
    }

    public function store(Request $request)
    {
        return $this->createCategory->store($request);
    }
    
    public function edit($id)
    {
        return $this->updateCategory->edit($id);
    }

    public function update(Request $request, $id)
    {
        return $this->updateCategory->update($request, $id);
    }
    
    public function destroy($id)
    {
        return $this->deleteCategory->destroy($id);
    }
}
