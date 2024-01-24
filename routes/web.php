<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodosController;
use App\Http\Controllers\CategoriesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Obtener todas las tareas
Route::get('/tareas', [TodosController::class, 'index'])->name('todos');
// Crear una tarea
Route::post('/tareas', [TodosController::class, 'store'])->name('todos');
// Obtener una tarea
Route::get('/tareas/{id}', [TodosController::class, 'show'])->name('todos-show');
// Actualizar una tarea
Route::patch('/tareas/{id}', [TodosController::class, 'update'])->name('todos-update');
// Eliminar una tarea
Route::delete('/tareas/{id}', [TodosController::class, 'destroy'])->name('todos-destroy');

Route::resource('categories', CategoriesController::class);