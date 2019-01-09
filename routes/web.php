<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/empresarios',function(){
    return view('empresario.tablero');
});

Route::post('/empresario/buscar_empresarios','EmpresarioController@buscar_empresarios');
Route::post('/empresario/agregar_modificar','EmpresarioController@agregar_modificar_empresario');
Route::post('/empresario/guardar','EmpresarioController@guardar_empresario');
Route::post('/empresario/desactivar','EmpresarioController@desactivar_empresario');
Route::post('/empresario/eliminar','EmpresarioController@eliminar_empresario');