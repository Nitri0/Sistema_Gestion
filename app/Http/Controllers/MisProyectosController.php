<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\Tipo;
use App\Master;
use App\Proyectos;
use App\Empresas;
use App\Roles;
use App\Avances;
use App\Dominios;
use App\User;
use App\MMEmpresasUsuarios;
use Input;
use App\Perfil;
use App\Clientes;
use App\GrupoEtapas;
use App\Plantillas;
use Session;
use URL;
use Illuminate\Http\Request;
use Gate;


define ('SITE_EMAILS', realpath("../resources/views/emails/"));
define ('FOOTER', "<br><br><p align='center'>Mensaje enviado a través de la plataforma de gestión de proyectos <a href={{url()}}>KeyGestión</a>. Todos los derechos reservados 2016<p>");


class MisProyectosController extends Controller {


	public function perfil(Request $request){
		$perfil = Perfil::where('id_usuario', $request->user()->id_usuario)->first();
		return view('mis_proyectos.perfil',['perfil'=>$perfil]);
	}

	public function postPerfil(Request $request){
		Perfil::where('id_usuario', $request->user()->id_usuario)->update($request->all());
		Session::flash('mensaje', 'Perfil actualizado exitosamente');
		return redirect("/mis-proyectos");
	}

	public function roles(){
		return view('mis_proyectos.rol');
	}

	public function postRoles(){
		$master = Master::where('nombre_maestro','Roles')->first();
		if(!$master){
			$master = Master::create(['nombre_maestro'=>'Roles']);
		}

		Tipo::create(['id_maestro'  => $master->id_maestro,
					  'nombre_tipo' => Input::get('nombre_tipo')]);

		Session::flash('mensaje', 'Rol creado exitosamente');
		return redirect("proyectos/create");	
	}	

	public function misProyectos(){
		$user = Auth::user();
		//FORMA DE LISTAR LAS COLUMNAS ESPECIFICAS COMO UN ARREGLO UNIDIMENCIONAL (SOLO VALUE)
		$tutorial = $user->tutorial;
		$isadmin = $user->isAdmin();
		$proyectos = json_encode(\DB::select('CALL p_busquedas(?,?,?)',array('listar_mis_proyectos',$user->id_usuario, $user->getIdEmpresa())));
		// $proyectos_id = Roles::where('id_usuario',$user->id_usuario)->lists('id_proyecto');
		// $proyectos = Proyectos::where('habilitado_proyecto',1)
		// 						->whereIn('id_proyecto',$proyectos_id)
		// 						->orderBy('id_avance', 'asc')
		// 						->paginate(10);

		return view('mis_proyectos.list',compact('proyectos','tutorial', 'isadmin'));
	}


	public function detalleMisProyectos($id_proyecto){

		$proyecto = Proyectos::where('id_proyecto',$id_proyecto)
								->where('id_empresa', Auth::user()->getIdEmpresa())
								->first();

		if (!$proyecto && $id_proyecto){
			return redirect('/mis-proyectos');
		}
		$rol = Roles::where('id_proyecto',$id_proyecto)
						->where('id_empresa',Auth::user()->getIdEmpresa())
						->get();
	
		$etapas = GrupoEtapas::where('id_grupo_etapas',$proyecto->id_grupo_etapas)
								->where('id_empresa', Auth::user()->getIdEmpresa())
								->first();

		$user = Auth::user();
		
		$progress = number_format( (float)((int) ($proyecto->estatus_proyecto-1) *100 / (int) $etapas->cantidad_etapas), 1,".", "" );

		if ($progress<0){
			$progress=0.0;
		}
		/*
		if (!$rol){
			return redirect('mis-proyectos/');
		}
		*/
		
		return view('mis_proyectos.detalle_proyecto',compact('proyecto','id_proyecto', 'rol', 'etapas','progress' ));
	}

	//__________________________________ CRUD AVANCES ____________________
	public function avancesMisProyectos($id_proyecto){

		$avances  = Avances::where('id_proyecto',$id_proyecto)
								->where('id_empresa',$user->getIdEmpresa())
								->orderBy('id_proyecto', 'desc')->paginate(10);

		return view('avances.list',compact('avances', 'id_proyecto'));
	}

	public function createAvancesMisProyectos($id_proyecto){
		$user = Auth::user();

		$proyecto = Proyectos::where('id_proyecto',$id_proyecto)
								->where('id_empresa',$user->getIdEmpresa())
								->first();
		if (!$proyecto){
			Session::flash('mensaje-error', 'No tiene permisos para ver ese registro');
			return redirect('mis-proyectos');
		}

		$plantillas = Plantillas::where('id_empresa',$user->getIdEmpresa())
								->get();

		$etapas = GrupoEtapas::find($proyecto->id_grupo_etapas)->getEtapas();

		$dominio = Dominios::find($proyecto->id_dominio);
		$mis_datos = Auth::user()->getPerfil();
		$mi_correo = Auth::user()->correo_usuario;
		return view('avances.create',compact('id_proyecto','proyecto','plantillas','etapas', 'mi_correo', 'mis_datos', 'dominio'));
	}	

	public function postCreateAvancesMisProyectos(Request $request,$id_proyecto){
		$proyecto = Proyectos::where('id_proyecto',$id_proyecto)
								->where('id_empresa',Auth::user()->getIdEmpresa())
								->first();

		if (!$proyecto ){
			Session::flash('mensaje-error', 'No es posible registrar avances en ese proyecto');
			return redirect('mis-proyectos');
		}

		$dominio = Dominios::find($proyecto->id_dominio);
		$mis_datos = Auth::user()->getPerfil();
		$mi_correo = Auth::user()->correo_usuario;
		$cliente = Clientes::find($proyecto->id_cliente);

		if ($request->check_copia_cliente_avance){
			$plantilla = Plantillas::where('id_plantilla',$request->id_plantilla)
									->where('id_empresa',Auth::user()->getIdEmpresa())
									->first();	

			if (!$plantilla ){
				Session::flash('mensaje-error', 'No es posible utilizar esa plantilla');
				return redirect('mis-proyectos');
			}

			$parametros_plantilla = ['proyecto'=>$proyecto,
									 'cliente' =>$cliente,
									 'dominio' =>$dominio,
									 'mis_datos' =>$mis_datos,
									 'mi_correo' =>$mi_correo,
									 'data'    =>$request->descripcion_avance];			
			$modelo_plantilla = $plantilla->nombre_archivo_plantilla;
			if (!$plantilla->nombre_archivo_plantilla){
				$modelo_plantilla = $plantilla->nombre_plantilla;
			};
			if (!file_exists(SITE_EMAILS."/".$modelo_plantilla.".blade.php")){
				$path = SITE_EMAILS."/".$plantilla->nombre_archivo_plantilla.".blade.php";
				file_put_contents($path,$plantilla->raw_data_plantilla.FOOTER);
			};			

			
			Helper::SendEmail(
							$cliente->email_cliente,
							$cliente->persona_contacto_cliente,
							$request->asunto_avance,
							'emails.'.$modelo_plantilla,
							$parametros_plantilla
							);
		};
		$request['id_usuario'] = Auth::user()->id_usuario;
		$request['id_empresa'] = Auth::user()->getIdEmpresa();
		$request['id_proyecto'] = $id_proyecto;
		Avances::firstOrCreate($request->except('check_cierre_etapa'));

		if ($request->check_cierre_etapa == 1){
			$bot_user = User::where('correo_usuario',"admin@admin.com")->first();
			if (!$bot_user){
				$id_usuario = Auth::user()->id_usuario;
			}else{
				$id_usuario = $bot_user->id_usuario;
			}
			$proyecto->estatus_proyecto = $proyecto->estatus_proyecto + 1;
			Avances::Create([
					'asunto_avance' 				=> 'Comienzo de nueva etapa.',
					'descripcion_avance' 			=> 'Comienzo de nueva etapa.',
					'id_empresa' 					=> Auth::user()->getIdEmpresa(),
					'id_usuario' 					=> $id_usuario,
					'id_proyecto' 					=> $id_proyecto,
					'id_etapa'	 					=> $proyecto->getIdEtapa(),
					'check_copia_cliente_avance' 	=> $request->check_copia_cliente_avance
				]);
		}

		$proyecto->save();

		Session::flash('mensaje', 'Avance creado exitosamente');
		return redirect('/mis-proyectos/'.$id_proyecto);
	}

	public function previewRealDataPlantillas( $id_proyecto,$id_plantilla){

		$plantilla = Plantillas::where('id_plantilla',$id_plantilla)
								->where('id_empresa',Auth::user()->getIdEmpresa())
								->first();

		$proyecto = Proyectos::where('id_proyecto',$id_proyecto)
								->where('id_empresa',Auth::user()->getIdEmpresa())
								->first();

		if (!$proyecto || !$plantilla){
			Session::flash('mensaje-error', 'No tiene permisos para ver ese registro');
			return redirect('mis-proyectos');
		}
		$cliente = Clientes::find($proyecto->id_cliente);
		$dominio = Dominios::find($proyecto->id_dominio);
		$mis_datos = Auth::user()->getPerfil();
		$mi_correo = Auth::user()->correo_usuario;		
		$data = "<Strong>Aqui va la descripcion del mensaje</strong>";

		$modelo_plantilla = $plantilla->nombre_archivo_plantilla;
		if (!$plantilla->nombre_archivo_plantilla){
			$modelo_plantilla = $plantilla->nombre_plantilla;
		};
		if (!file_exists(SITE_EMAILS."/".$modelo_plantilla.".blade.php")){
			$path = SITE_EMAILS."/".$modelo_plantilla.".blade.php";
			file_put_contents($path,$plantilla->raw_data_plantilla.FOOTER);
		};		
		return view('emails.'.$modelo_plantilla,compact('proyecto','cliente','data','dominio','mis_datos','mi_correo'));
	}		
	//__________________________________END CRUD AVANCES ____________________



	public function perfilEmpresa(Request $request){
		$relacion = MMEmpresasUsuarios::where('id_usuario',Auth::user()->id_usuario)->first();

		$empresa = Empresas::find( $relacion->id_empresa );
		//dd($empresa);
		return view('mis_proyectos.perfil_empresa',['empresa'=>$empresa]);
	}

	public function postPerfilEmpresa(Request $request){

		$relacion = MMEmpresasUsuarios::where('id_usuario',Auth::user()->id_usuario)->first();
		Empresas::find( $relacion->id_empresa )->update($request->all());
		//Perfil::where('id_usuario', $request->user()->id_usuario)->update($request->all());
		Session::flash('mensaje', 'Perfil actualizado exitosamente');
		return redirect("/mis-proyectos");
	}


}

