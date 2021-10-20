@extends('layouts.plantilla')
@section('contenido')
    <h1>Panel de administración de Destinos</h1>

    @if (session('mensaje'))
        <div class="alert alert-success">
            {{ session('mensaje') }}
        </div>
    @endif

    <table class="table table-borderless table-striped table-hover">
        <thead>
        <tr>
            <th>Destino (aeropuerto)</th>
            <th>Región</th>
            <th>Precio</th>
            <th colspan="2">
                <a href="/agregarDestino" class="btn btn-outline-secondary">
                    Agregar
                </a>
            </th>
        </tr>
        </thead>
        <tbody>

            <tr>
                <td> destNombre </td>
                <td> regNombre </td>
                <td> destPrecio </td>
                <td>
                    <a href="/modificarDestino/id" class="btn btn-outline-secondary">
                        Modificar
                    </a>
                </td>
                <td>
                    <a href="/eliminarDestino/id" class="btn btn-outline-secondary">
                        Eliminar
                    </a>
                </td>
            </tr>


        </tbody>
    </table>
@endsection
