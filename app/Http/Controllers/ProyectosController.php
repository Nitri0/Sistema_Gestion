<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Proyectos;
use App\Clientes;
use App\Dominios;
use App\User;
use App\Tipo;
use App\Roles;
use App\TipoProyectos;
use App\Avances;
use App\Master;
use App\GrupoEtapas;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Session;
use Gate;

class ProyectosController extends Controller {

	public function __construct(){
		$this->beforeFilter('@permisos');
		$this->beforeFilter('@find', ['only' => ['show','update','edit','destroy']]);
	}


	#______________________________ Filtros _________________________________
	public function find(Route $route){
		$this->proyecto = Proyectos::find($route->getParameter('proyectos'));
	}

	public function permisos(Route $route){
		// FORMA DE OBTENER LOS METODOS DE UNA CLASE
		// $class = new \ReflectionClass($this);
		// $metodos = [];
		// foreach ($class->getMethods(\ReflectionMethod::IS_PUBLIC ) as $route){
		// 	if ($route->class == 'App\Http\Controllers\ProyectosController'){
		// 		array_push($metodos, $route->name);
		// 	}
		// };
		// dd($metodos);
		//dd($route->getName());
		if(Gate::denies('proyectos', $route->getName()) ){
			Session::flash("mensaje-error","No tiene permisos para acceder al modulo: ".$route->getName());
			return redirect('/mis-proyectos');
		};
	}


	#______________________________ Metodos _________________________________
	public function index(){

		$proyectos = json_encode(\DB::select('CALL p_busquedas(?,?)',array('listar_todos_proyectos','')));
		return view('proyectos.list', compact('proyectos'));
	}

	public function create(){
		$clientes = Clientes::all();
		
		$maestro = Master::where('nombre_maestro','Roles')->first();
		if (!$maestro){
			$id_maestro = Master::create(['nombre_maestro','Roles'])->id_maestro;
		}else{
			$id_maestro = $maestro->id_maestro;
		};
		$usuarios = User::all();
		$roles = Tipo::where('id_maestro',$id_maestro)->get();
		$grupo_etapas = GrupoEtapas::all();
		$tipo_proyectos = TipoProyectos::all();
		return view('proyectos.create',compact('clientes', 'usuarios', 'roles','grupo_etapas','tipo_proyectos'));
	}

	public function edit($id){
		return view('proyectos.edit', ['proyecto'=>$this->proyecto]);
	}

	public function show($id_proyecto){
		$rol = Roles::where('id_proyecto',$id_proyecto)->get();
		/*
		if (!$rol){
			return redirect('mis-proyectos/');
		}
		*/
		$maestro = Master::where('nombre_maestro','Roles')->first();
		$proyecto = Proyectos::find($id_proyecto);
		$etapas = GrupoEtapas::find($proyecto->id_grupo_etapas);
		$usuarios = User::all();
		$roles = Tipo::where('id_maestro',$maestro->id_maestro)->get();

		return view('proyectos.detalle',compact('proyecto','id_proyecto', 'rol', 'etapas','roles','usuarios' ));

	}

	public function store(Request $request){
		//$request["fecha_avance"] = Carbon::now();
		//dd($request->all());
		$proyecto = Proyectos::create($request->all());

		$etapa = GrupoEtapas::find($proyecto->id_grupo_etapas)->getFirstEtapa();

		if ($request['id_dominio']){			
		 	Dominios::where('id_dominio',$request['id_dominio'])->update(['habilitado_dominio'=>0]);
		};

		if ($request->cantidad>0){
			foreach (range(0, $request->cantidad-1) as $index) {
				Roles::create(['id_usuario' => $request['id_usuario'.$index],
							'id_tipo_rol' => $request['id_rol'.$index],
							'id_proyecto'=> $proyecto->id_proyecto]);
						};
		};
		
		
		Avances::Create([
						'id_proyecto'=>$proyecto->id_proyecto,
						'asunto_avance'=>'Iniciando Proyecto',
						'descripcion_avance'=>'Proyecto creado exitosamente',
						'id_etapa'=>$etapa->id_etapa,
					]);
		Session::flash('mensaje', 'Proyecto creado exitosamente');
		return redirect('/proyectos');
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
		$proyectos = json_encode(\DB::select('CALL p_busquedas(?,?)',array('listar_todos_proyectos_finalizados','')));
		return view('proyectos.list_proyectos_finalizados', compact('proyectos'));
	}

	public function indexProyectosPorIntegrantes(){
		$proyectos = json_encode(\DB::select('CALL p_busquedas(?,?)',array('listar_todos_proyectos_finalizados','')));
		return view('proyectos.list_proyectos_finalizados', compact('proyectos'));
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

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function agregarIntegrante(Request $request){
		Roles::firstOrCreate($request->except('redirect'));
		return redirect($request['redirect']);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function eliminarIntegrante($id, Request $request)
	{
		Roles::find($id)->delete();
		return redirect($request['redirect']);
	}	


}
