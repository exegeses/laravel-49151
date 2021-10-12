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
