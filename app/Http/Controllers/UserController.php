<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\Tipo;
use App\Master;
use App\Proyectos;
use App\Roles;
use App\Avances;
use Input;
use App\Perfil;
use App\Clientes;
use App\GrupoEtapas;
use App\Plantillas;
use Session;
use URL;
use Illuminate\Http\Request;

define ('SITE_EMAILS', realpath("../resources/views/emails/"));

class UserController extends Controller {


	public function perfil(Request $request){
		$perfil = Perfil::where('id_usuario', $request->user()->id_usuario)->first();
		return view('user.perfil',['perfil'=>$perfil]);
	}

	public function postPerfil(Request $request){
		Perfil::where('id_usuario', $request->user()->id_usuario)->update($request->all());
		Session::flash('mensaje', 'Perfil actualizado exitosamente');
		return redirect("/gestion");
	}

	public function roles(){
		return view('user.rol');
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
		$proyectos_id = Roles::where('id_usuario',$user->id_usuario)->lists('id_proyecto');
		$proyectos = Proyectos::where('habilitado_proyecto',1)
								->whereIn('id_proyecto',$proyectos_id)
								->paginate(10);
		return view('user.mis_proyectos',compact('proyectos'));
	}


	public function detalleMisProyectos($id_proyecto){

		$user = Auth::user();
		$rol = Roles::where('id_usuario',$user->id_usuario)->where('id_proyecto',$id_proyecto)->get();
		/*
		if (!$rol){
			return redirect('mis-proyectos/');
		}
		*/
		$proyecto = Proyectos::find($id_proyecto);
		$etapas = GrupoEtapas::find($proyecto->id_grupo_etapas);


		return view('user.detalle_proyecto',compact('proyecto','id_proyecto', 'rol', 'etapas'));
	}

	//__________________________________ CRUD AVANCES ____________________
	public function avancesMisProyectos($id_proyecto){

		//$proyecto = Proyectos::find($id_proyecto);
		$avances  = Avances::where('id_proyecto',$id_proyecto)->paginate(10);

		return view('avances.list',compact('avances', 'id_proyecto'));
	}

	public function createAvancesMisProyectos($id_proyecto){
		$user = Auth::user();
		$plantillas = Plantillas::all();
		$proyectos_id = Roles::where('id_usuario',$user->id_usuario)->lists('id_proyecto');
		$proyecto = Proyectos::find($id_proyecto);//aqui siempre trae un solo proyecto... arreglar
		$etapas = GrupoEtapas::find($proyecto->id_grupo_etapas)->getEtapas();
		return view('avances.create',compact('id_proyecto', 'proyecto','plantillas','etapas'));
	}	

	public function postCreateAvancesMisProyectos(Request $request,$id_proyecto){

		$avances = Avances::create($request->all());

		$proyecto = Proyectos::find($id_proyecto);

		if ($request->check_cierre_etapa==1){
			$proyecto = Proyectos::find($request->id_proyecto);
			$proyecto->estatus_proyecto = $proyecto->estatus_proyecto + 1;
			$proyecto->save();
		}
		$cliente = Clientes::find($proyecto->id_cliente);
		$plantilla = Plantillas::find($request->id_plantilla);

		$parametros_plantilla = ['proyecto'=>$proyecto,
								 'cliente' =>$cliente,
								 'data'    =>$request->descripcion_avance];

		if ($request->check_copia_cliente_avance){
			Helper::SendEmail(
							$cliente->email_cliente,
							$cliente->persona_contacto_cliente,
							$request->asunto_avance,
							'emails.'.$plantilla->nombre_plantilla,
							$parametros_plantilla
							);
		}
		Session::flash('mensaje', 'Avance creado exitosamente');
		return redirect('/mis-proyectos/'.$id_proyecto);
	}
	//__________________________________END CRUD AVANCES ____________________
	//__________________________________ CRUD PLANTILLAS ____________________
	public function plantillas($id=0){
		$plantilla="";
		if ($id){
			$plantilla = Plantillas::find($id);
		}
		Session::flash('history-back',URL::previous());
		return view('plantillas.create')->with('plantillas',$plantilla);
	}

	public function postPlantillas(Request $request){
		$plantillas = Plantillas::create($request->all());
        //$url = "uploads/temp/";
        $path = SITE_EMAILS."/".$request->nombre_plantilla.".blade.php";
		file_put_contents($path,$request->raw_data_plantilla);

		if (Session::has('history-back')){
			return redirect(Session::get('history-back'));
		}
		return redirect('/mis-proyectos');
	}	

	public function putPlantillas(Request $request, $id){
		Plantillas::where('id_plantilla',$id)->update($request->all());
		$path = SITE_EMAILS."/".$request->nombre_plantilla.".blade.php";
		file_put_contents($path,$request->raw_data_plantilla);
		if (Session::has('history-back')){
			return redirect(Session::get('history-back'));
		}
		return redirect('/mis-proyectos');
	}	

	public function previewPlantillas( $id_proyecto,$id_plantilla){
		//dd($id_plantilla, $id_proyecto);
		$plantilla = Plantillas::find($id_plantilla);
		$proyecto = Proyectos::find($id_proyecto);
		$cliente = Clientes::find($proyecto->id_cliente);
		$data = "<Strong>Aqui va la descripcion del mensaje</strong>";
		return view('emails.'.$plantilla->nombre_plantilla,compact('proyecto','cliente','data'));
	}		
	//__________________________________END CRUD PLANTILLAS ____________________	
}

