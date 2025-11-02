<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\GuardarCategoryRequest;
use App\Models\Category;
use App\Models\User;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $categories = Category::paginate(4);
        //$categories = Category::all();
        return view('category.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        //$users = DB::table('users')->where('role', 'admin')->get();

        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GuardarCategoryRequest $request)                    
    {
    
        $category = new Category;
        $category->title = $request->title;
        $category->url_clean = $request->url_clean;
        $category->save();

        return back()->with('status', '<h1>Creació post OK</h1>');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('category.show', ['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('category.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $category->update($request->all());
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return back();
    }
}
