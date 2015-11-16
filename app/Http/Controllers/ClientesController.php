<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use App\Clientes;
use Session;
use redirect;
use Gate;


class ClientesController extends Controller {

	public function __construct(){
		$this->beforeFilter('@permisos');
		$this->beforeFilter('@find', ['only' => ['show','update','edit','destroy']]);
	}

	public function find(Route $route){
		$this->cliente = Clientes::find($route->getParameter('clientes'));
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
		if(Gate::denies('clientes', $route->getName()) ){
			Session::flash("mensaje-error","No tiene permisos para acceder al modulo: ".$route->getName());
			return redirect('/mis-proyectos');
		};
	}

	public function index(){
		$clientes = Clientes::orderBy('id_cliente', 'desc')->paginate(10);
		return view('clientes.list', compact('clientes'));
	}

	public function create(){
		$cliente = "";
		return view('clientes.create', compact('cliente'));
	}

	public function store(Request $request){
		Clientes::create($request->all());
		Session::flash('mensaje', 'Cliente creado exitosamente');
		return redirect('/clientes');
	}

	public function show($id){
		return view('clientes.detalle',['cliente'=>$this->cliente]);
	}

	public function edit($id){
		return view('clientes.create',['cliente'=>$this->cliente]);
	}

	public function update($id, Request $request){
		$cliente = Clientes::find($id)->update($request->all());
		Session::flash('mensaje', 'Cliente editado exitosamente');
		return redirect("/clientes");
	}

	public function destroy($id){
		Clientes::find($id)->delete();
		return redirect("/clientes");
	}

	public function prueba($id){
		Clientes::find($id)->delete();
		return redirect("/clientes");
	}

}
