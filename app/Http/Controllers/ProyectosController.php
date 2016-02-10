<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Proyectos;
use App\Clientes;
use App\Dominios;
use App\User;
use App\TipoRoles;
use App\Roles;
use App\Avances;
use App\Master;
use App\MMEmpresasUsuarios;
use App\GrupoEtapas;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Session;
use Gate;
use Auth;

class ProyectosController extends Controller {

	public function __construct(){
		$this->beforeFilter('@permisos');
		$this->beforeFilter('@find', ['only' => ['show','update','edit','destroy']]);
	}


	#______________________________ Filtros _________________________________
	public function find(Route $route){
		if($route->getParameter('proyectos')){
			if(Auth::user()->isSuperAdmin()){
				$this->proyecto = Proyectos::where('id_proyecto', $route->getParameter('proyectos'))
											->first();
			}else{

				$this->proyecto = Proyectos::where('id_empresa', Auth::user()->getIdEmpresa())
											->where('id_proyecto', $route->getParameter('proyectos'))
											->first();
				if (!$this->proyecto){
					return redirect('/proyectos');
				}
			}
		}
	}

	public function permisos(Route $route){
		if(Gate::denies('proyectos', $route->getName()) ){
			Session::flash("mensaje-error","No tiene permisos para acceder al modulo: ".$route->getName());
			return redirect('/mis-proyectos');
		};
	}


	#______________________________ Metodos _________________________________
	public function index(){

		$proyectos = json_encode(\DB::select('CALL p_busquedas(?,?,?)',array('listar_todos_proyectos','', Auth::user()->getIdEmpresa() ) ));
		return view('proyectos.list', compact('proyectos'));
	}

	public function create(){
		$clientes = Clientes::where('id_empresa', Auth::user()->getIdEmpresa())->get();
		$idusuarios = MMEmpresasUsuarios::where('id_empresa', Auth::user()->getIdEmpresa())
										->get()
										->pluck('id_usuario')
										->toArray();

		$usuarios = User::whereIn('id_usuario',$idusuarios)->get();
		$roles = TipoRoles::where('id_empresa',Auth::user()->getIdEmpresa())
							->where('habilitado_tipo', 1)->get();
		$grupo_etapas = GrupoEtapas::where('id_empresa', Auth::user()->getIdEmpresa())
									->where('habilitado_grupo_etapas', 1)
									->get();
		return view('proyectos.create',compact('clientes', 'usuarios', 'roles','grupo_etapas'));
	}

	public function edit($id){
		return view('proyectos.edit', ['proyecto'=>$this->proyecto]);
	}

	public function show($id_proyecto){
		$rol = Roles::where('id_proyecto',$id_proyecto)->get();

		$proyecto = $this->proyecto;
		//dd($proyecto);
		$etapas = GrupoEtapas::find($proyecto->id_grupo_etapas);
		//->get()->pluck('modulo_excepcion')->toArray();
		$idusuarios = MMEmpresasUsuarios::where('id_empresa', Auth::user()->getIdEmpresa())
										->get()
										->pluck('id_usuario')
										->toArray();
		//dd( $idusuarios );
		$usuarios = User::whereIn('id_usuario',$idusuarios)->get();
		$roles = TipoRoles::where('id_empresa',Auth::user()->getIdEmpresa())
							->where('habilitado_tipo', 1)
							->get();

		$progress = number_format( (float)((int) ($proyecto->estatus_proyecto-1) *100 / (int) $etapas->cantidad_etapas), 1,".", "" );

		if ($progress<0){
			$progress=0.0;
		}
		//dd($progress);
		return view('proyectos.detalle',compact('proyecto','id_proyecto', 'rol', 'etapas','roles','usuarios', 'progress' ));

	}

	public function store(Request $request){
		//$request["fecha_avance"] = Carbon::now();
		//dd($request->all());
		$request['id_usuario'] = Auth::user()->id_usuario;
		$request['id_empresa'] = Auth::user()->getIdEmpresa();
		$proyecto = Proyectos::create($request->all());

		$etapa = GrupoEtapas::find($proyecto->id_grupo_etapas)->getFirstEtapa();
		if ($request->cantidad>0){
			foreach (range(0, $request->cantidad-1) as $index) {
				Roles::create(['id_usuario' => $request['id_usuario'.$index],
							'id_tipo_rol' => $request['id_rol'.$index],
							'id_proyecto'=> $proyecto->id_proyecto,
							'id_empresa'=> Auth::user()->getIdEmpresa()
							]);
						};
		};
		//dd('prueba1 '.json_encode($etapa));
		$bot_user = User::where('correo_usuario',"admin@admin.com")->first();
		Avances::Create([
						'id_proyecto'=>$proyecto->id_proyecto,
						'asunto_avance'=>'Iniciando Proyecto',
						'descripcion_avance'=>'Proyecto creado exitosamente',
						'id_empresa'=> Auth::user()->getIdEmpresa(),
						'id_etapa'=>$etapa->id_etapa,
						'id_usuario'=>$bot_user->id_usuario,

					]);
		Session::flash('mensaje', 'Proyecto creado exitosamente');
		$json = [
				'success'=>true,
		];
		return json_encode($json);
		//return redirect('/proyectos');
	}

	public function update($id, Request $request){
		//$request["fecha_avance"] = Carbon::now();
		Session::flash('mensaje', 'Proyecto creado exitosamente');
		return redirect('/proyectos');
	}	

	public function destroy($id){
		$proyecto = Proyectos::find($id);
		Avances::where('id_proyecto',$proyecto->id_proyecto)->delete();
		Roles::where('id_proyecto',$proyecto->id_proyecto)->delete();
		Dominios::where('id_proyecto',$proyecto->id_proyecto)->update(['habilitado_dominio'=>1, 'id_proyecto' => NULL]);
		$proyecto->delete();

		return redirect('/proyectos');
	}	

	public function finalizarProyecto($id){
		$proyecto = Proyectos::where('id_proyecto',$id)->update(['habilitado_proyecto'=>0,]);
		Session::flash('mensaje', 'Proyecto finalizado exitosamente');
		return redirect('/proyectos');
	}	


	public function reiniciarProyecto($id){
		$proyecto = Proyectos::where('id_proyecto',$id)->update(['habilitado_proyecto'=>1,]);
		Session::flash('mensaje', 'Proyecto reiniciado exitosamente');
		return redirect('/proyectos-finalizados');
	}		


	public function indexProyectosFinalizados(){
		$proyectos = json_encode(\DB::select('CALL p_busquedas(?,?,?)',array('listar_todos_proyectos_finalizados','',Auth::user()->getIdEmpresa())));
		return view('proyectos.list_proyectos_finalizados', compact('proyectos'));
	}
/*
	public function indexProyectosPorIntegrantes(){
		$proyectos = json_encode(\DB::select('CALL p_busquedas(?,?,?)',array('listar_todos_proyectos_finalizados','',Auth::user()->getIdEmpresa())));
		return view('proyectos.list_proyectos_finalizados', compact('proyectos'));
	}
*/
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function agregarIntegrante(Request $request){
		$integrantes =Roles::where('id_proyecto', $request->id_proyecto)
						->where('id_usuario', $request->id_usuario)
						->first();
		if (!$integrantes){
			Roles::firstOrCreate($request->except('redirect'));
			return(json_encode(['success'=>true]));
			//return redirect($request['redirect']);
		};
		Session::flash('mensaje-error','No es posible agregar a una integrante más de una vez en un mismo proyecto.');
		return(json_encode(['success'=>false]));
		//return redirect($request['redirect']);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function eliminarIntegrante($id, Request $request)
	{
		$id_empresa = Auth::user()->getIdEmpresa();
		$usuario = Roles::find($id);

		if ($usuario && Roles::where('id_proyecto', $usuario->id_proyecto)->count()>1){
			$usuario->delete();
			return(json_encode(['success'=>false]));
			return redirect($request['redirect']);
		};
		Session::flash('mensaje-error', 'Un proyecto debe tener por lo menos un integrante.');		
		return redirect($request['redirect']);		
	}	


}
