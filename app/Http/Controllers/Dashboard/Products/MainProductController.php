<?php

namespace App\Http\Controllers\Dashboard\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainProductController extends Controller
{
    protected $readProduct;
    protected $createProduct;
    protected $updateProduct;
    protected $deleteProduct;

    public function __construct(
        ReadProductController $readProduct,
        CreateProductController $createProduct,
        UpdateProductController $updateProduct,
        DeleteProductController $deleteProduct
    )
    {
        $this->middleware(['permission:create_product'])->only('create', 'store');
        $this->middleware(['permission:read_product'])->only('index');
        $this->middleware(['permission:update_product'])->only('edit', 'update');
        $this->middleware(['permission:delete_product'])->only('destroy');
        $this->readProduct = $readProduct;
        $this->createProduct = $createProduct;
        $this->updateProduct = $updateProduct;
        $this->deleteProduct = $deleteProduct;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->readProduct->index($request);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return $this->createProduct->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       return $this->createProduct->store($request);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return $this->updateProduct->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        return $this->updateProduct->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return $this->deleteProduct->destroy($id);
    }
}
