<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Requests\CategoryRequest;
use Exception;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return CategoryResource::collection($categories)->additional(['meta' => 'Categoria mostrada correctament']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $category->load('posts');
        return (new CategoryResource($category))->additional(['meta' => 'Categoria mostrada correctament']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        try {
            // ACTUALITZACIÓ DE LES DADES
            $category->update($request->all());
            return (new CategoryResource($category))->additional(['meta' => 'Categoria modificada correctament']);
        } catch (Exception $e) {
            // GESTIÓ DE L'ERROR
            // Retorna un JSON amb un missatge d'error i un codi d'estat 500
            return response()->json([
                'message' => 'S\'ha produït un error al tractar les dades',
                // El següent és opcional i només s'hauria de mostrar en entorns de desenvolupament (APP_DEBUG=true)
                'error_details' => $e->getMessage(),
            ], 200);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->all();
        $category = Category::create($data);

        return new CategoryResource($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return (new CategoryResource($category))->additional(['meta' => 'Categoria eliminada correctament']);
        } catch (Exception $e) {
            // GESTIÓ DE L'ERROR
            // Retorna un JSON amb un missatge d'error i un codi d'estat 500
            return response()->json([
                'message' => 'S\'ha produït un error al tractar les dades',
                // El següent és opcional i només s'hauria de mostrar en entorns de desenvolupament (APP_DEBUG=true)
                'error_details' => $e->getMessage(),
            ], 200);
        }
    }

    // Cerca per 'agrupació de rutes'
    public function find($value)
    {
       $query = Category::with('posts');

       $category = is_numeric($value)
            ? $query->findOrFail($value)  // Cerca per ID
            : $query->where('title','like', "%".$value."%")  // Cerca per regNumber
                    ->firstOrFail();

        return (new CategoryResource($category))->additional(['meta' => 'Categoria trobada correctament']);
    }

    // Cerca per 'Rutes separades'
    public function findById($id)
    {
        $category = Category::findOrFail($id); // Cerca per id
        return (new CategoryResource($category))->additional(['meta' => 'Categoria trobada per ID']);
    }
    public function findByTitle($value)
    {
        $category = Category::where('title','like', "%".$value."%")->firstOrFail(); // Cerca per 'title'    
        return (new CategoryResource($category))->additional(['meta' => 'Categoria trobada correctament']);
    }

}