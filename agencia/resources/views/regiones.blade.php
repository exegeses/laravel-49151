@extends('layouts.plantilla')

    @section('contenido')
        <h1>Listado de regiones</h1>

        <ul class="list-group col-4">
        @foreach( $regiones as $region )
            <li class="list-group-item list-group-item-action">
                {{ $region->regNombre }}
            </li>
        @endforeach
        </ul>

    @endsection
