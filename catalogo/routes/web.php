<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

###################################
#######  CRUD de marcas
use App\Http\Controllers\MarcaController;
Route::get('/adminMarcas', [ MarcaController::class, 'index' ]);
Route::get('/agregarMarca', [ MarcaController::class, 'create' ]);
Route::post('/agregarMarca', [ MarcaController::class, 'store' ]);
Route::get('/modificarMarca/{id}', [ MarcaController::class, 'edit' ]);
Route::patch('/modificarMarca', [ MarcaController::class, 'update' ]);
Route::get('/eliminarMarca/{id}', [ MarcaController::class, 'confirmarBaja' ]);
Route::delete('/eliminarMarca', [ MarcaController::class, 'destroy' ]);

###################################
#######  CRUD de categorías
use App\Http\Controllers\CategoriaController;
Route::get('/adminCategorias', [ CategoriaController::class, 'index' ]);

###################################
#######  CRUD de productos
use App\Http\Controllers\ProductoController;
Route::get('/adminProductos', [ ProductoController::class, 'index' ]);
Route::get('/agregarProducto', [ ProductoController::class, 'create' ]);
Route::post('/agregarProducto', [ ProductoController::class, 'store' ]);
Route::get('/modificarProducto/{id}', [ ProductoController::class, 'edit' ]);
Route::patch('/modificarProducto', [ ProductoController::class, 'update' ]);
