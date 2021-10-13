<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

#### edit
Route::get('/inicio', function ()
{
    return view('inicio');
});

### listado de regiones
Route::get('/regiones', function ()
{
    //obtenemos listado de regiones
    $regiones = DB::select('
                        SELECT regID, regNombre
                            FROM regiones'
                    );
    return view('regiones', [ 'regiones'=>$regiones ] );
});
