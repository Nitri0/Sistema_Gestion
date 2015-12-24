<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use App\Clientes;
use Session;
use redirect;
use Gate;
use Auth;


class ConfiguracionController extends Controller {

	public function __construct(){
	$this->InfoModulos = [

		"dominios" =>[
				"nombre_menu" => 'Dominios',
				"icon" => 'fa fa-link',
				"items_menu" => ['index'=>'Listar',
								 'create'=>'Agregar'],
				"administrador_usuarios"=>
						[     "index"   => [
						                    "Listar",
						                    "Permite acceso a la pantalla donde se listan los registros",
						                ],
						      "show"    => [
						                    "Mostrar",
						                    "Permite acceso a la pantalla donde se muestra el detalle de los registros",
						                ],
						      "create"  =>  [
						                    "Crear",
						                    "Permite acceso a la pantalla donde se rellena el formulario de creacion de un registro",
						                ],
						      "store"   =>  [
						                    "Guardar",
						                    "Permite acceso a crear un registro. (Requiere el permiso Crear)",
						                ],
						      "edit"    =>  [
						                    "Editar",
						                    "Permite acceso a editar un registro.",
						                ],
						      "update"  => [
						                    "Actualizar",
						                    "Permite acceso a actualizar un registro. (Requiere el permiso Editar)",
						                ],
						      "destroy" => [
						                    "Eliminar",
						                    "Permite acceso a crear un registro. (Requiere el permiso Crear)",
						                ],
						      "actualizarEspacioUsado" => [
						                    "Actualizar espacio usado",
						                    "",
						                ],
						],
			],

		"clientes" =>[
				"nombre_menu" => 'Clientes',
				"icon" => 'fa fa-wheelchair',
				"items_menu" => ['index'=>'Listar',
								 'create'=>'Agregar'],
				"administrador_usuarios" =>		
						[
						    "index"   => [
						                    "Listar",
						                    "Permite acceso a la pantalla donde se listan los registros",
						                ],
						      "show"    => [
						                    "Mostrar",
						                    "Permite acceso a la pantalla donde se muestra el detalle de los registros",
						                ],
						      "create"  =>  [
						                    "Crear",
						                    "Permite acceso a la pantalla donde se rellena el formulario de creacion de un registro",
						                ],
						      "store"   =>  [
						                    "Guardar",
						                    "Permite acceso a crear un registro. (Requiere el permiso Crear)",
						                ],
						      "edit"    =>  [
						                    "Editar",
						                    "Permite acceso a editar un registro.",
						                ],
						      "update"  => [
						                    "Actualizar",
						                    "Permite acceso a actualizar un registro. (Requiere el permiso Editar)",
						                ],
						      "destroy" => [
						                    "Eliminar",
						                    "Permite acceso a crear un registro. (Requiere el permiso Crear)",
						                ],
						],
				],

		"plantillas" =>[
				"nombre_menu" => 'Plantillas',
				"icon" => 'fa fa-paste',
				"items_menu" => ['index'=>'Listar',
								 'create'=>'Agregar'],
				"administrador_usuarios"=>
						[     
						    "index"   => [
						                    "Listar",
						                    "Permite acceso a la pantalla donde se listan los registros",
						                ],
						      "show"    => [
						                    "Mostrar",
						                    "Permite acceso a la pantalla donde se muestra el detalle de los registros",
						                ],
						      "create"  =>  [
						                    "Crear",
						                    "Permite acceso a la pantalla donde se rellena el formulario de creacion de un registro",
						                ],
						      "store"   =>  [
						                    "Guardar",
						                    "Permite acceso a crear un registro. (Requiere el permiso Crear)",
						                ],
						      "edit"    =>  [
						                    "Editar",
						                    "Permite acceso a editar un registro.",
						                ],
						      "update"  => [
						                    "Actualizar",
						                    "Permite acceso a actualizar un registro. (Requiere el permiso Editar)",
						                ],
						      "destroy" => [
						                    "Eliminar",
						                    "Permite acceso a crear un registro. (Requiere el permiso Crear)",
						                ],
						      "previewPlantillas" => [
						                    "Previsualizar plantillas",
						                    "Permite mostrar la información de plantillas creadas. (Requiere el permiso Listar)",
						                ],
						],
				],

		"tipo_proyectos" =>	[
				"nombre_menu" => 'Tipo de proyectos',
				"icon" => 'fa fa-suitcase',
				"items_menu" => ['index'=>'Listar',
								 'create'=>'Agregar'],
				"administrador_usuarios"=>	
						[     
						    "index"   => [
						                    "Listar",
						                    "Permite acceso a la pantalla donde se listan los registros",
						                ],
						      "show"    => [
						                    "Mostrar",
						                    "Permite acceso a la pantalla donde se muestra el detalle de los registros",
						                ],
						      "create"  =>  [
						                    "Crear",
						                    "Permite acceso a la pantalla donde se rellena el formulario de creacion de un registro",
						                ],
						      "store"   =>  [
						                    "Guardar",
						                    "Permite acceso a crear un registro. (Requiere el permiso Crear)",
						                ],
						      "edit"    =>  [
						                    "Editar",
						                    "Permite acceso a editar un registro.",
						                ],
						      "update"  => [
						                    "Actualizar",
						                    "Permite acceso a actualizar un registro. (Requiere el permiso Editar)",
						                ],
						      "destroy" => [
						                    "Eliminar",
						                    "Permite acceso a crear un registro. (Requiere el permiso Crear)",
						                ],
						],     
			],   

		"proyectos" =>[
				"nombre_menu" => 'Proyectos',
				"icon" => 'fa fa-sitemap',
				"items_menu" => ['index'=>'Proyectos activos',
								 'indexProyectosFinalizados'=>'Proyectos finalizados',],
				"administrador_usuarios"=>
						[    
						    "index"   => [
						                    "Listar",
						                    "Permite acceso a la pantalla donde se listan los registros",
						                ],
						      "show"    => [
						                    "Mostrar",
						                    "Permite acceso a la pantalla donde se muestra el detalle de los registros",
						                ],
						      "create"  =>  [
						                    "Crear",
						                    "Permite acceso a la pantalla donde se rellena el formulario de creacion de un registro",
						                ],
						      "store"   =>  [
						                    "Guardar",
						                    "Permite acceso a crear un registro. (Requiere el permiso Crear)",
						                ],
						      "edit"    =>  [
						                    "Editar",
						                    "Permite acceso a editar un registro.",
						                ],
						      "update"  => [
						                    "Actualizar",
						                    "Permite acceso a actualizar un registro. (Requiere el permiso Editar)",
						                ],
						      "destroy" => [
						                    "Eliminar",
						                    "Permite acceso a crear un registro. (Requiere el permiso Crear)",
						                ],
						      "indexProyectosFinalizados" => [
						                    "Listar proyectos finalizados",
						                    "",
						                ],
						      "finalizarProyecto" => [
						                    "Finalizar proyectos",
						                    "(Requiere el permiso Mostrar)",
						                ],
						      "reiniciarProyecto" => [
						                    "Re-Abrir proyecto",
						                    "(Requiere el permiso Mostrar)",
						                ],
						      "agregarIntegrante" => [
						                    "Agregar integrantes a proyectos creados",
						                    "(Requiere el permiso mostrar)",
						                ],
						      "eliminarIntegrante" => [
						                    "Eliminar integrantes de proyectos creados",
						                    "(Requiere el permiso mostrar)",
						                ],
						],
				],

		"grupo_etapas" =>[
				"nombre_menu" => 'Grupo de etapas',
				"icon" => 'fa fa-line-chart',
				"items_menu" => ['index'=>'Listar',
								 'create'=>'Agregar',],
				"administrador_usuarios"=>
						[     
						    "index"   => [
						                    "Listar",
						                    "Permite acceso a la pantalla donde se listan los registros",
						                ],
						      "show"    => [
						                    "Mostrar",
						                    "Permite acceso a la pantalla donde se muestra el detalle de los registros",
						                ],
						      "create"  =>  [
						                    "Crear",
						                    "Permite acceso a la pantalla donde se rellena el formulario de creacion de un registro",
						                ],
						      "store"   =>  [
						                    "Guardar",
						                    "Permite acceso a crear un registro. (Requiere el permiso Crear)",
						                ],
						      "edit"    =>  [
						                    "Editar",
						                    "Permite acceso a editar un registro.",
						                ],
						      "update"  => [
						                    "Actualizar",
						                    "Permite acceso a actualizar un registro. (Requiere el permiso Editar)",
						                ],
						      "destroy" => [
						                    "Eliminar",
						                    "Permite acceso a crear un registro. (Requiere el permiso Crear)",
						                ],
						      ],
				],

		"roles" =>[
				"nombre_menu" => 'Roles de usuarios',
				"icon" => 'fa fa-coffee',
				"items_menu" => ['index'=>'Listar',
								 'create'=>'Agregar'],
				"administrador_usuarios"=>
						[     
						    "index"   => [
						                    "Listar",
						                    "Permite acceso a la pantalla donde se listan los registros",
						                ],
						      "show"    => [
						                    "Mostrar",
						                    "Permite acceso a la pantalla donde se muestra el detalle de los registros",
						                ],
						      "create"  =>  [
						                    "Crear",
						                    "Permite acceso a la pantalla donde se rellena el formulario de creacion de un registro",
						                ],
						      "store"   =>  [
						                    "Guardar",
						                    "Permite acceso a crear un registro. (Requiere el permiso Crear)",
						                ],
						      "edit"    =>  [
						                    "Editar",
						                    "Permite acceso a editar un registro.",
						                ],
						      "update"  => [
						                    "Actualizar",
						                    "Permite acceso a actualizar un registro. (Requiere el permiso Editar)",
						                ],
						      "destroy" => [
						                    "Eliminar",
						                    "Permite acceso a crear un registro. (Requiere el permiso Crear)",
						                ],
						],
				],

		"empresas_proveedoras" =>[
				"nombre_menu" => 'Empresas Proveedoras',
				"icon" => 'fa fa-coffee',
				"items_menu" => ['index'=>'Listar',
								 'create'=>'Agregar'],
				"administrador_usuarios"=>
						[     
						    "index"   => [
						                    "Listar",
						                    "Permite acceso a la pantalla donde se listan los registros",
						                ],
						      "show"    => [
						                    "Mostrar",
						                    "Permite acceso a la pantalla donde se muestra el detalle de los registros",
						                ],
						      "create"  =>  [
						                    "Crear",
						                    "Permite acceso a la pantalla donde se rellena el formulario de creacion de un registro",
						                ],
						      "store"   =>  [
						                    "Guardar",
						                    "Permite acceso a crear un registro. (Requiere el permiso Crear)",
						                ],
						      "edit"    =>  [
						                    "Editar",
						                    "Permite acceso a editar un registro.",
						                ],
						      "update"  => [
						                    "Actualizar",
						                    "Permite acceso a actualizar un registro. (Requiere el permiso Editar)",
						                ],
						      "destroy" => [
						                    "Eliminar",
						                    "Permite acceso a crear un registro. (Requiere el permiso Crear)",
						                ],
						],
			],
		];

	}
}
