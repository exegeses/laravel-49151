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
    /*
     $regiones = DB::select('

                        SELECT regID, regNombre
                            FROM regiones'
                    );
    */
    $regiones = DB::table('regiones')->get();

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
    /*
     $destinos = DB::select(
                    'SELECT destID, destNombre, regNombre, destPrecio
                        FROM destinos d
                            JOIN regiones r
                            ON d.regID = r.regID'
                    );*/
    $destinos = DB::table('destinos as d')
                        ->join('regiones as r', 'd.regID', '=', 'r.regID')
                        ->select('destID', 'destNombre', 'regNombre', 'destPrecio')
                        ->get();
    return view('adminDestinos',
                    [ 'destinos'=>$destinos ]
            );
});
Route::get( '/agregarDestino', function()
{
    //obtenemnos listado de regiones
    $regiones = DB::table('regiones')->get();
    return view('agregarDestino', [ 'regiones'=>$regiones ]);
});
Route::post('/agregarDestino', function()
{
    //capturamos los datos
    $destNombre = $_POST['destNombre'];
    $regID = $_POST['regID'];
    $destPrecio = $_POST['destPrecio'];
    $destAsientos = $_POST['destAsientos'];
    $destDisponibles = $_POST['destDisponibles'];
    //insertamos datos
    /*
     DB::insert(
                'INSERT INTO destinos
                    ( destNombre, regID, destPrecio, destAsientos, destDisponibles )
                 VALUE
                    ( :destNombre, :regID, :destPrecio, :destAsientos, :destDisponibles )',
                 [ $destNombre, $regID, $destPrecio, $destAsientos, $destDisponibles ]
    );*/
    DB::table('destinos')
            ->insert(
                [
                    'destNombre'  => $destNombre,
                    'regID'       => $regID,
                    'destPrecio'  => $destPrecio,
                    'destAsientos'=> $destAsientos,
                    'destDisponibles' => $destDisponibles
                ]
            );
        return redirect('/adminDestinos')
                    ->with([ 'mensaje' => 'Destino: '.$destNombre.' agregado correctamente' ]);
});
Route::get('/modificarDestino/{id}', function ($destID)
{
    //obtenemos datos de un destino por su id
    $destino = DB::table('destinos')->where('destID', $destID)->first();
    //obtenemos listado de regiones
    $regiones = DB::table('regiones')->get();
    //retornamos vista del form
    return view('modificarDestino',
                    [
                        'destino'  => $destino,
                        'regiones' => $regiones
                    ]
            );
});
