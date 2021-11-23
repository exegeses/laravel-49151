@extends('layouts.plantilla')

    @section('contenido')

        <h1>Baja de una marca</h1>

        <div class="alert alert-light shadow col-6 mx-auto p-4">

            Se eliminará la marca:
            <span class="lead">
                {{ $Marca->mkNombre }}
            </span>
            <form action="/eliminarMarca" method="post">
        @method('delete')
        @csrf
                <input type="hidden" name="mkNombre"
                       value="{{ $Marca->mkNombre }}">
                <input type="hidden" name="idMarca"
                       value="{{ $Marca->idMarca }}">
                <button class="btn btn-danger btn-block my-3">
                    Confirmar baja
                </button>
                <a href="/adminMarcas" class="btn btn-light btn-block">
                    volver a panel
                </a>
            </form>
        </div>

        <script>
            Swal.fire(
                'Advertencia!',
                'Su pulsa el botón "Confirmar baja", se eliminará la marca seleccionada',
                'warning'
            );
        </script>

    @endsection
