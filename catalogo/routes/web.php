<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

###################################
#######  CRUD de marcas
use App\Http\Controllers\MarcaController;
Route::get('/adminMarcas', [ MarcaController::class, 'index' ]);

###################################
#######  CRUD de categorías
use App\Http\Controllers\CategoriaController;
Route::get('/adminCategorias', [ CategoriaController::class, 'index' ]);
