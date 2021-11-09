@extends('layouts.plantilla')

    @section('contenido')

        <h1>Alta de una nueva marca</h1>

        <div class="alert bg-light border border-white shadow round col-8 mx-auto p-4">

            <form action="/agregarMarca" method="post">
                <div class="form-group">
                    <label for="mkNombre">Nombre de la marca</label>
                    <input type="text" name="mkNombre"
                           class="form-control" id="mkNombre" required>
                </div>
                <button class="btn btn-dark mr-3">Agregar marca</button>
                <a href="/adminMarcas" class="btn btn-outline-secondary">
                    Volver a panel
                </a>
            </form>
        </div>



    @endsection

