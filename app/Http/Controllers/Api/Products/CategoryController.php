<?php

namespace App\Http\Controllers\Api\Products;

use App\Http\Requests\Products\Category\CreateCategoryRequest;
use App\Http\Requests\Products\Category\UpdateCategoryRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Resource;
use App\Services\Products\CategoriesHandlerService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function resource($data)
    {
        return new Resource($data);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Resource::collection(CategoriesHandlerService::getList());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCategoryRequest $request)
    {
        $validated = $request->validated();

        return $this->resource([$validated]);
        return $this->resource(CategoriesHandlerService::createCategory($validated));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validated();

        return $this->resource(CategoriesHandlerService::updateCategory($id));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->resource(CategoriesHandlerService::deleteCategory($id));
    }
}
