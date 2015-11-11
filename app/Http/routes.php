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

	Route::get('/gestion', 'VistasController@gestion');
	Route::get( '/perfil', 'UserController@perfil');
	Route::post('/perfil', 'UserController@postPerfil');
	Route::get( '/roles', 'UserController@roles');
	Route::post('/roles', 'UserController@postRoles');
	
	//___________________ Preview Plantillas _____________________________	
	Route::get('/plantillas/preview/{id_plantilla}', 'PlantillasController@previewPlantillas');
	Route::get('/plantillas/preview/{id_proyecto}/{id_plantilla}', 'PlantillasController@previewRealDataPlantillas');
	/*
	Route::get('/plantillas/', 'PlantillasController@listPlantillas');
	Route::get('/plantillas/create/{id?}', 'PlantillasController@plantillas');
	Route::post('/plantillas', 'PlantillasController@postPlantillas');
	Route::post('/plantillas/{id}', 'PlantillasController@putPlantillas');
	
*/
	Route::post( '/proyectos/finalizar/{id}', 'ProyectosController@finalizarProyecto');


	Route::get( '/mis-proyectos', 'UserController@misProyectos');
	Route::get( '/mis-proyectos/{id}', 'UserController@detalleMisProyectos');
	Route::get( '/mis-proyectos/avances/{id_proyecto}/', 'UserController@avancesMisProyectos');
	Route::get( '/mis-proyectos/avances/{id_proyecto}/create', 'UserController@createAvancesMisProyectos');
	Route::Post('/mis-proyectos/avances/{id_proyecto}/create', 'UserController@postCreateAvancesMisProyectos');
	Route::get( '/mis-proyectos/avances/{id_proyecto}/{id_avance}', 'UserController@detalleAvancesMisProyectos');


	//___________________ Cruds _____________________________
	route::resource('/plantillas','PlantillasController');
	route::resource('integrantes','IntegrantesController');
	Route::resource('clientes', 'ClientesController');
	Route::resource('grupo_etapas', 'EtapasController');
	Route::resource('dominios', 'DominiosController');
	//Route::resource('avances', 'AvancesController');
	Route::resource('proyectos', 'ProyectosController');
	Route::resource('empresas_proveedoras', 'EmpresasProveedorasController');
});

#_____________________ Login __________________________
Route::get( 'login', 'LoginController@login');
Route::post('login', 'LoginController@postLogin');
Route::get('logout', 'LoginController@Logout');
Route::get( 'registro', 'LoginController@registro');
Route::post('registro', 'LoginController@postRegistro');


