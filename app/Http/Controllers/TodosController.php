<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\Category;

class TodosController extends Controller
{
    /*
     * index para mostrar todos los registros
     * create para crear un registro
     * store para guardar un registro
     * edit para mostrar el formulario de edicion
     * update para actualizar un registro
     * destroy para eliminar un registro
    */

    public function index()
    {
        $todos = Todo::all();
        $category = Category::all();

        return view('todos.index', ['todos' => $todos, 'categories' => $category]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3|max:100',
            'category_id' => 'required',
        ]); // validamos los datos
        
        $todo = new Todo; // instanciamos el modelo
        $todo->title = $request->title; // guardamos el valor del input
        $todo->category_id = $request->category_id;
        $todo->save(); // guardamos el registro en la base de datos
        
        return redirect()->route('todos')->with('success', 'Tarea creada correctamente');
    }

    public function show($id)
    {
        $todo = Todo::find($id);
        return view('todos.edit', ['todo' => $todo]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|min:3|max:100',
        ]); // validamos los datos
        
        $todo = Todo::find($id); // obtenemos el registro
        $todo->title = $request->title; // guardamos el valor del input
        
        // dd($todo);
        
        $todo->save(); // guardamos el registro en la base de datos
        
        return redirect()->route('todos')->with('success', 'Tarea actualizada correctamente');
    }

    public function destroy($id)
    {
        $todo = Todo::find($id);
        $todo->delete();
        return redirect()->route('todos')->with('success', 'Tarea eliminada correctamente');
    }


}
