<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Requests\GuardarCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return CategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GuardarCategoryRequest $request)
    {
        $data = $request->all();
        $category = Category::create($data);

        return new CategoryResource($category);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return (new CategoryResource($category))->additional(['meta' => 'Categoria creada correctament']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GuardarCategoryRequest $request, Category $category)
    {
        $category->update($request->all());
        return (new CategoryResource($category))->additional(['meta' => 'Categoria modificada correctament']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return (new CategoryResource($category))->additional(['meta' => 'Categoria eliminada correctament']);
    }
  
}