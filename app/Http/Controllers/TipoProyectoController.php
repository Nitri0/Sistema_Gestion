<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Etapas;
use App\GrupoEtapas;
use App\TipoProyecto;

use Session;
use Illuminate\Routing\Route;
use Illuminate\Http\Request;
use Gate;

class TipoProyectoController extends Controller {

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
		if(Gate::denies('tipo_proyectos', $route->getName()) ){
			Session::flash("mensaje-error","No tiene permisos para acceder al modulo: ".$route->getName());
			return redirect('/mis-proyectos');
		};
	}

	public function index(){
		$tipo_proyectos = TipoProyecto::paginate(10);
		return view('tipo_proyectos.list',compact('tipo_proyectos'));
	}

	public function create(){
		return view('tipo_proyectos.create');
	}


	public function store(Request $request){
		$grupoEtapas = TipoProyecto::create($request->all());

		Session::flash('mensaje', 'Tipo de Proyecto creado exitosamente');
		return redirect('/tipo_proyectos');
	}


	public function show($id){
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
		Etapas::where('id_tipo_proyecto',$id)->delete();
		GrupoEtapas::find($id)->delete();
		return redirect('/tipo_proyectos');
	}

}
