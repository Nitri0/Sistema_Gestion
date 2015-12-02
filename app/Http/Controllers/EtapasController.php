<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Etapas;
use App\GrupoEtapas;
use Session;
use Illuminate\Routing\Route;
use Illuminate\Http\Request;
use Gate;
use Auth;

class EtapasController extends Controller {

	public function __construct(){
		$this->beforeFilter('@permisos');
	}

	public function find(Route $route){
		//$this->cliente = Clientes::find($route->getParameter('clientes'));
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
		if(Gate::denies('etapas', $route->getName()) ){
			Session::flash("mensaje-error","No tiene permisos para acceder al modulo: ".$route->getName());
			return redirect('/mis-proyectos');
		};
	}

	public function index(){
		$grupo_etapas = GrupoEtapas::where('id_empresa',Auth::user()->getIdEmpresa())
										->paginate(10);
		return view('etapas.list',compact('grupo_etapas'));
	}

	public function create(){
		return view('etapas.create');
	}


	public function store(Request $request){
		$request['id_usuario'] = Auth::user()->id_usuario;
		$request['id_empresa'] = Auth::user()->getIdEmpresa();
		$grupoEtapas = GrupoEtapas::create($request->all());

		if ($request->cantidad_etapas>0){
			foreach (range(0, $request->cantidad_etapas-1) as $index) {
				Etapas::create(['nombre_etapa' => $request['nombre_etapa_'.$index],
							   'numero_orden_etapa' => $index+1,
							   'id_grupo_etapas' => $grupoEtapas->id_grupo_etapas]);

				};
		};
		
		Session::flash('mensaje', 'Grupo de etapas creado exitosamente');
		return redirect('/grupo_etapas');
	}


	public function show($id){
		$grupo_etapas = GrupoEtapas::where('id_grupo_etapas',$id)
									->where('id_empresa', Auth::user()->getIdEmpresa())
									->first();
		if ($grupo_etapas){
			return view('etapas.detalle', compact('grupo_etapas'));
		}
		Session::flash('mensaje-error', 'No tiene permisos para ver ese registro');
		return view('/grupo_etapas', compact('grupo_etapas'));
	}


	public function edit($id)
	{
		//
	}


	public function update($id)
	{
		//
	}


	public function destroy($id){
		Etapas::where('id_grupo_etapas',$id)->delete();
		GrupoEtapas::find($id)->delete();
		return redirect('/grupo_etapas');
		//Dominios::destroy($proyecto->)
	}

}
