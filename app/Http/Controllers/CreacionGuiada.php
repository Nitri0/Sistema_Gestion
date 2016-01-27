<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use App\Clientes;
use App\GrupoEtapas;
use App\User;
use App\TipoRoles;
use App\MMEmpresasUsuarios;
use Session;
use redirect;
use Gate;
use Auth;


class CreacionGuiada extends Controller {

	//______________INICIANDO
	
	public function iniciando(){
		return view('creacion_guiada.iniciando');
	}

	//______________PASO 1
	public function pasoClientesListar(){
		$clientes = json_encode(Clientes::where('id_empresa', Auth::user()->getIdEmpresa())
											->where('habilitado_cliente',1)
											->orderBy('id_cliente', 'desc')
											->get());		
		return view('creacion_guiada.paso_clientes_listar', ['clientes'=>$clientes]);
	}

	public function pasoClientesCrear(){
		return view('creacion_guiada.paso_clientes_crear');

	}

	//______________PASO 2
	public function pasoTipoProyectosListar(){
		$tipo_proyectos = json_encode(GrupoEtapas::where('id_empresa',Auth::user()->getIdEmpresa())
										->orderBy('id_grupo_etapas','desc')
										->where('habilitado_grupo_etapas',1)
										->get());		
		return view('creacion_guiada.paso_tipo_proyectos_listar', ['tipo_proyectos'=>$tipo_proyectos]);
	}

	public function pasoTipoProyectosCrear(){
		return view('creacion_guiada.paso_tipo_proyectos_crear');
	}



	//______________PASO 3
	public function pasoUsuariosListar(){
        $idusuarios = MMEmpresasUsuarios::where('id_empresa', Auth::user()->getIdEmpresa())
                                            ->get()
                                            ->pluck('id_usuario')
                                            ->toArray();
        $usuarios = json_encode(User::whereIn('id_usuario',$idusuarios)
                            
                            ->get());
		return view('creacion_guiada.paso_usuarios_listar', ['usuarios'=>$usuarios]);
	}

	public function pasoUsuariosCrear(){
		return view('creacion_guiada.paso_usuarios_crear');
	}



	//______________PASO 4
	public function pasoRolesListar(){
		$roles = json_encode( TipoRoles::where('id_empresa', Auth::user()->getIdEmpresa()) 
								->where('habilitado_tipo', 1) 
								->orderBy('id_tipo_rol', 'desc')
								->get() );		
		return view('creacion_guiada.paso_roles_listar', ['roles'=>$roles]);
	}

	public function pasoRolesCrear(){
		return view('creacion_guiada.paso_roles_crear');
	}

	//______________FINALIZANDO
	
	public function finalizando(){
		return view('creacion_guiada.finalizando');
	}	
}
