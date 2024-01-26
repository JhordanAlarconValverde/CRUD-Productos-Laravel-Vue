<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Models\Categoria;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('categoria.index');
});

// Categoria
Route::get('/categoria', [CategoriaController::class, 'index'])->name('categoria');
Route::post('/categoria', [CategoriaController::class, 'store'])->name('categoria.store');
Route::post('/categoria/actualizar', [CategoriaController::class, 'update'])->name('categoria.update');
Route::get('/categoria/eliminar/{id}', [CategoriaController::class, 'delete'])->name('categoria.delete');
Route::get('/categoria/table', [CategoriaController::class, 'table'])->name('categoria.table');

// Producto
Route::get('/producto', [ProductoController::class, 'index'])->name('producto');
Route::post('/producto', [ProductoController::class, 'store'])->name('producto.store');
Route::post('/producto/actualizar', [ProductoController::class, 'update'])->name('producto.update');
Route::get('/producto/eliminar/{id}', [ProductoController::class, 'delete'])->name('producto.delete');
Route::get('/producto/table', [ProductoController::class, 'table'])->name('producto.table');
