<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'VistasController@index');
Route::get('gestion', 'VistasController@gestion');
Route::resource('clientes', 'ClientesController');
Route::resource('dominios', 'DominiosController');
Route::resource('avances', 'AvancesController');
Route::resource('proyectos', 'ProyectosController');
Route::resource('empresas_proveedoras', 'EmpresasProveedorasController');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);


