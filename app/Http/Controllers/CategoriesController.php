<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        
        return view('categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:100',
            'color' => 'required|max:7',
        ]); // validamos los datos
        
        $category = new Category; // instanciamos el modelo
        $category->name = $request->name; // guardamos el valor del input
        $category->color = $request->color;
        $category->save(); // guardamos el registro en la base de datos
        
        return redirect()->route('categories.index')->with('success', 'Categoría creada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);
        return view('categories.show', ['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|min:3|max:100',
            'color' => 'required|max:7',
        ]); // validamos los datos
        
        $category = Category::find($id); // obtenemos el registro
        $category->name = $request->name; // guardamos el valor del input
        $category->color = $request->color;
        $category->save(); // guardamos el registro en la base de datos
        
        return redirect()->route('categories.index')->with('success', 'Categoría actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Categoría eliminada correctamente');
    }
}
