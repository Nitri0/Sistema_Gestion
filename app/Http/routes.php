<?php

Route::get('/', 'VistasController@index');

#_____________________ Login __________________________
$router->group(['middleware' => 'guest' ], function() {
	Route::get( 'login', 'LoginController@login');
});
Route::post('login', 'LoginController@postLogin');
Route::get('logout', 'LoginController@Logout');

#____________________ Registro ________________________
Route::get('registrar', 'LoginController@registro');
Route::post('registrar', 'LoginController@postRegistro');

#____________________ Registro ________________________
Route::get('recuperar-contraseña', 'LoginController@forgetPassword');
Route::post('recuperar-contraseña', 'LoginController@postForgetPassword');
Route::any('activacion/{id_usuario}',  'LoginController@HabilitarUsuario');

$router->group(['middleware' => 'auth'], function() {

	Route::get('/gestion', 'VistasController@gestion');
	Route::post('/contactame', 'Helper@contactame');
	Route::post('/inscribir-empresa', 'AdministradorEmpresasController@inscribirEmpresa');

	Route::post('/mostrar-tutorial', 'MisProyectosController@mostrar_tutorial');
	Route::post('/desactivar-tutorial', 'MisProyectosController@desactivar_tutorial');

#______________________________________ PLANTILLAS _____________________________________________
	Route::get('/plantillas/preview/{plantillas}',['as'  => 'plantillas.previewPlantillas',
						 							 'uses'=>'PlantillasController@previewPlantillas']);
	Route::get('plantillas/{plantillas}/destroy', 'PlantillasController@destroy');	
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


	Route::get('proyectos-internos/create', 'ProyectosController@createProyectoInterno');
	Route::post('proyectos-internos', 'ProyectosController@storeProyectoInterno');

	Route::get('proyectos/{proyectos}/destroy', 'ProyectosController@destroy');
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
	Route::get( '/perfil-empresa', 'MisProyectosController@perfilEmpresa');
	Route::post('/perfil-empresa', 'MisProyectosController@postPerfilEmpresa');
	Route::get('/reset-password', 'LoginController@resetPassword');
	Route::post('/reset-password', 'LoginController@postResetPassword');

#______________________________________ DOMINIOS _______________________________________________	
	Route::get('/dominios/updateData', ['as'  => 'dominios.actualizarEspacioUsado',
										'uses'=>'DominiosController@actualizarEspacioUsado']);
					#____________________ cruds ____________________________
	Route::get('dominios/{dominios}/destroy', 'DominiosController@destroy');
	Route::resource('dominios', 'DominiosController');


#______________________________________ CLIENTES _______________________________________________	
					#____________________ cruds ____________________________
	Route::post('/clientes/valididentificador/', 'ClientesController@validRif');
	Route::get('clientes/{clientes}/destroy', 'ClientesController@destroy');
	Route::resource('clientes', 'ClientesController');


#_______________________________________ ETAPAS ________________________________________________	
					#____________________ cruds ____________________________
	Route::get('tipo_proyectos/{tipo_proyectos}/destroy', 'EtapasController@destroy');
	Route::resource('tipo_proyectos', 'EtapasController');

#__________________________________ EMPRESAS PROVEEDORAS _______________________________________	
					#____________________ cruds ____________________________

	Route::get('empresas_proveedoras/{empresas_proveedoras}/destroy', 'EmpresasProveedorasController@destroy');	
	Route::resource('empresas_proveedoras', 'EmpresasProveedorasController');

#________________________________ ADMINISTRADOR DE USUARIOS _____________________________________
					#____________________ cruds ____________________________	
	Route::get('admin_usuarios/{admin_usuarios}/destroy', 'AdministradorUsuariosController@destroy');
	Route::get('admin_usuarios/{admin_usuarios}/habilitar', 'AdministradorUsuariosController@habilitar');
	Route::get('admin_usuarios/{id}/permisos',  ['as'  => 'admin_usuario.editPermisos',
												'uses'=>'AdministradorUsuariosController@editPermisos']);
	Route::post('/admin_usuarios/validUser/', 'AdministradorUsuariosController@validUser');	
	Route::resource('admin_usuarios', 'AdministradorUsuariosController');

#________________________________ ADMINISTRADOR DE EMPRESAS _____________________________________
					#____________________ cruds ____________________________	
	Route::post('/valididentificador/', 'AdministradorEmpresasController@validRif');
	Route::get('admin_empresas/{admin_empresas}/destroy', 'AdministradorEmpresasController@destroy');
	Route::get('admin_empresas/{admin_empresas}/habilitar', 'AdministradorEmpresasController@habilitar');
	Route::resource('admin_empresas', 'AdministradorEmpresasController');
		
#________________________________ ROLES DE USUARIOS _____________________________________
					#____________ agregar roles a integrantes _________________
	Route::get('roles/{roles}/destroy', 'RolesController@destroy');
	Route::resource('/roles', 'RolesController');
	//Route::get( '/roles', 'ProyectosController@roles');
	//Route::post('/roles', 'ProyectosController@postRoles');


#__________________________ ASISTENTE DE CREACION DE PROYECTOS ________________________________

	Route::get('asistente/iniciando', 'CreacionGuiada@iniciando');

	Route::get('asistente/paso1/list', 'CreacionGuiada@pasoClientesListar');
	Route::get('asistente/paso1/create', 'CreacionGuiada@pasoClientesCrear');


	Route::get('asistente/paso2/list', 'CreacionGuiada@pasoTipoProyectosListar');
	Route::get('asistente/paso2/create', 'CreacionGuiada@pasoTipoProyectosCrear');

	Route::get('asistente/paso3/list', 'CreacionGuiada@pasoUsuariosListar');
	Route::get('asistente/paso3/create', 'CreacionGuiada@pasoUsuariosCrear');

	Route::get('asistente/paso4/list', 'CreacionGuiada@pasoRolesListar');
	Route::get('asistente/paso4/create', 'CreacionGuiada@pasoRolesCrear');

	Route::get('asistente/paso5/create', 'CreacionGuiada@pasoProyectosCrear');

	Route::get('asistente/finalizado', 'CreacionGuiada@finalizando');
	#________________________________ Actiividades _____________________________________
				#____________ agregar actividades y subactividades _________________
	Route::any('actividades/adjuntar', 'ActividadesController@adjuntar');
	Route::post('actividades/destruir', 'ActividadesController@destroy');
	Route::post('actividades/update', 'ActividadesController@update');
	Route::post('actividades/comentario', 'ActividadesController@agregarComentario');
	Route::post('actividades/finalizartarea', 'ActividadesController@finalizarTarea');
	Route::resource('actividades', 'ActividadesController');
	

});