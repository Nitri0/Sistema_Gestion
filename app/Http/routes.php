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
	

#______________________________________ PLANTILLAS _____________________________________________
	Route::get('/plantillas/preview/{id_plantilla}',['as'  => 'plantillas.previewPlantillas',
						 							 'uses'=>'PlantillasController@previewPlantillas']);
					#____________________ cruds ____________________________	
	route::resource('plantillas','PlantillasController');


#______________________________________ PROYECTOS ______________________________________________
	Route::post( '/proyectos/finalizar/{id}',['as'  => 'proyectos.finalizarProyecto', 
											  'uses'=>'ProyectosController@finalizarProyecto']);

	Route::post( '/proyectos/reabrir/{id}', ['as'  => 'proyectos.reiniciarProyecto',
											 'uses'=>'ProyectosController@reiniciarProyecto']);

	Route::get( '/proyectos-finalizados', ['as'  => 'proyectos.indexProyectosFinalizados',
										   'uses'=>'ProyectosController@indexProyectosFinalizados']);

					#__________ agregar integrantes a proyectos _______________
	Route::post( '/integrantes/', ['as'  => 'proyectos.agregarIntegrante',
								   'uses'=>'ProyectosController@agregarIntegrante']);

	Route::delete( '/integrantes/{id}',['as'  => 'proyectos.eliminarIntegrante',
										'uses'=>'ProyectosController@eliminarIntegrante'] );

					#____________ agregar roles a integrantes _________________
	Route::get( '/roles', 'ProyectosController@roles');
	Route::post('/roles', 'ProyectosController@postRoles');

					#____________________ cruds ____________________________
	Route::resource('proyectos', 'ProyectosController');


#___________________________________ MIS PROYECTOS _____________________________________________
	Route::get( '/mis-proyectos', 'MisProyectosController@misProyectos');
	Route::get( '/mis-proyectos/{id}', 'MisProyectosController@detalleMisProyectos');
	Route::get( '/mis-proyectos/avances/{id_proyecto}/', 'MisProyectosController@avancesMisProyectos');
	Route::get( '/mis-proyectos/avances/{id_proyecto}/create', 'MisProyectosController@createAvancesMisProyectos');
	Route::Post('/mis-proyectos/avances/{id_proyecto}/create', 'MisProyectosController@postCreateAvancesMisProyectos');
	Route::get( '/mis-proyectos/avances/{id_proyecto}/{id_avance}', 'MisProyectosController@detalleAvancesMisProyectos');
	Route::get('/plantillas/preview/{id_proyecto}/{id_plantilla}',
						['as'  => 'mis-proyectos.previewRealDataPlantillas',
						 'uses'=>'MisProyectosController@previewRealDataPlantillas']);
	Route::get( '/perfil', 'MisProyectosController@perfil');
	Route::post('/perfil', 'MisProyectosController@postPerfil');

#______________________________________ DOMINIOS _______________________________________________	
	Route::get('/dominios/updateData', ['as'  => 'dominios.actualizarEspacioUsado',
										'uses'=>'DominiosController@actualizarEspacioUsado']);
					#____________________ cruds ____________________________
	Route::resource('dominios', 'DominiosController');


#______________________________________ CLIENTES _______________________________________________	
					#____________________ cruds ____________________________
	Route::resource('clientes', 'ClientesController');


#_______________________________________ ETAPAS ________________________________________________	
					#____________________ cruds ____________________________
	Route::resource('grupo_etapas', 'EtapasController');

#__________________________________ EMPRESAS PROVEEDORAS _______________________________________	
					#____________________ cruds ____________________________	
	Route::resource('empresas_proveedoras', 'EmpresasProveedorasController');


#________________________________ ADMINISTRADOR DE USUARIOS _____________________________________
					#____________________ cruds ____________________________	
	Route::resource('admin_usuarios', 'AdministradorUsuariosController');
	Route::get('admin_usuarios/{id}/permisos',  ['as'  => 'admin_usuario.editPermisos',
												 'uses'=>'AdministradorUsuariosController@editPermisos']);

});

#_____________________ Login __________________________
Route::get( 'login', 'LoginController@login');
Route::post('login', 'LoginController@postLogin');
Route::get('logout', 'LoginController@Logout');


