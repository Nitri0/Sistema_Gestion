<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use App\Clientes;
use App\Empresas;
use Session;
use redirect;
use Gate;


class AdministradorEmpresasController extends Controller {

	public function __construct(){
		$this->beforeFilter('@permisos');
		$this->beforeFilter('@find', ['only' => ['show','update','edit','destroy']]);
	}

	public function find(Route $route){
		$this->empresa = Empresas::find($route->getParameter('admin_empresas'));
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
		if(Gate::denies('admin_empresas', $route->getName()) ){
			Session::flash("mensaje-error","No tiene permisos para acceder al modulo: ".$route->getName());
			return redirect('/mis-proyectos');
		};
	}

	public function index(){
		$empresas = Empresas::orderBy('id_empresa', 'desc')->paginate(10);
		return view('empresas.list', compact('empresas'));
	}

	public function create(){
		$empresa = "";
		return view('empresas.create', compact('empresa'));
	}

	public function store(Request $request){
		Empresas::create($request->all());
		Session::flash('mensaje', 'Empresa creada exitosamente');
		return redirect('/admin_empresas');
	}

	public function show($id){
		return view('empresas.detalle',['empresa'=>$this->empresa]);
	}

	public function edit($id){
		return view('empresas.create',['empresa'=>$this->empresa]);
	}

	public function update($id, Request $request){
		Empresas::find($id)->update($request->all());
		Session::flash('mensaje', 'Cliente editado exitosamente');
		return redirect("/admin_empresas");
	}

	public function destroy($id){
		Clientes::find($id)->delete();
		return redirect("/admin_empresas");
	}

}
