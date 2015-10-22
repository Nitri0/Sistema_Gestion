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

$router->group(['middleware' => 'auth'], function() {

	Route::get('gestion', 'VistasController@gestion');
	Route::resource('clientes', 'ClientesController');
	Route::resource('dominios', 'DominiosController');
	Route::resource('avances', 'AvancesController');
	Route::resource('proyectos', 'ProyectosController');
	Route::resource('empresas_proveedoras', 'EmpresasProveedorasController');
});

#_____________________ Login __________________________
Route::get( 'login', 'LoginController@login');
Route::post('login', 'LoginController@postLogin');
Route::get('logout', 'LoginController@Logout');
Route::get( 'registro', 'LoginController@registro');
Route::post('registro', 'LoginController@postRegistro');


