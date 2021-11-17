<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\Producto;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //obtenemos listado de marcas
        $marcas = Marca::paginate(6);
        return view('adminMarcas', [ 'marcas'=>$marcas ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('agregarMarca');
    }

    private function validarForm(Request $request)
    {
        $request->validate(
            [ 'mkNombre'=>'required|min:2|max:50' ],
            [
                'mkNombre.required'=>'El campo "Nombre de la marca" es obligatorio.',
                'mkNombre.min'=>'El campo "Nombre de la marca" debe tener al menos 2 caractéres.',
                'mkNombre.max'=>'El campo "Nombre de la marca" debe tener 50 caractéres como máximo.'
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //capturamos dato
        $mkNombre = $request->mkNombre;
        //validamos
        $this->validarForm($request);
        //instanciamos, asignamos, guardamos
        $Marca = new Marca;
        $Marca->mkNombre = $mkNombre;
        $Marca->save();
        //redirección + mensaje ok
        return redirect('/adminMarcas')
                    ->with([ 'mensaje'=>'Marca: '.$mkNombre.' agregada correctamente' ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //obtenemos datos de marca
        $Marca = Marca::find($id);
        //retornamos vista del form con datos
        return view('modificarMarca', [ 'Marca'=>$Marca ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request )
    {
        $mkNombre = $request->mkNombre;
        //validacion
        $this->validarForm($request);
        //obtenemos datos de la marca
        $Marca = Marca::find( $request->idMarca );
        //asignacion & guardar
        $Marca->mkNombre = $mkNombre;
        $Marca->save();
        //retornar redicacción con mesaje ok
        return redirect('/adminMarcas')
                ->with([ 'mensaje'=>'Marca: '.$mkNombre.' modificada correctamente' ]);
    }

    private function productoPorMarca($idMarca)
    {
        //$check = Producto::where('idMarca', $idMarca)->first();
        $check = Producto::firstWhere('idMarca', $idMarca);
        //$check = Producto::where('idMarca', $idMarca)->count();
        return $check;
    }

    public function confirmarBaja($id)
    {
        //obtenemos datos de una marca
        $Marca = Marca::find($id);
        //si NO HAY productos de esa marca
        if ( !$this->productoPorMarca($id) ){
            return 'es nulo';
            //retornamos vista de confirmación
        }
        //redirección con mensaje que no se puede borrar
        return redirect('/adminMarcas')
                ->with([ 'mensaje'=>'No se puede eliminar la marca: '.$Marca->mkNombre.' ya que tiene productos relacionados.' ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
