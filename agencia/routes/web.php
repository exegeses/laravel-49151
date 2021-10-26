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


########################################
######  CRUD de regiones
Route::get('/adminRegiones', function()
{
    $regiones = DB::select('SELECT regID, regNombre FROM regiones');
    return view('adminRegiones', [ 'regiones'=>$regiones ]);
});
Route::get('/agregarRegion', function ()
{
    return view('agregarRegion');
});
Route::post('/agregarRegion', function ()
{
    //capturar dato enviado
    $regNombre = $_POST['regNombre'];
    //insertar en tabla regiones
    DB::insert('INSERT INTO regiones
                            ( regNombre )
                         VALUE
                            ( :regNombre )',
                [ $regNombre ]
            );
    //redirección con mensaje ok ('flashing')
    return redirect('/adminRegiones')
                ->with([ 'mensaje'=>'Región: '.$regNombre.' agregada correctamente.' ]);
});
Route::get('/modificarRegion/{regID}', function ($regID)
{
    //obtenemos datos de una región por su id
    $region = DB::select(
                        'SELECT regID, regNombre
                            FROM regiones
                            WHERE regID = :regID',
                        [ $regID ]
                    );
    return view('modificarRegion', [ 'region'=>$region ]);
});

########################################
######  CRUD de destinos
Route::get('/adminDestinos', function ()
{
    //obtenemos un listado de destinos
    $destinos = DB::select(
                    'SELECT destID, destNombre, regNombre, destPrecio
                        FROM destinos d
                            JOIN regiones r
                            ON d.regID = r.regID'
                    );
    return view('adminDestinos',
                    [ 'destinos'=>$destinos ]
            );
});
