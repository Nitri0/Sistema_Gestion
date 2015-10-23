<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Dominios;
use App\Clientes;
use App\EmpresasProveedoras;
use Illuminate\Http\Request;
use Session;

class DominiosController extends Controller {

	public function __construct(){
		$this->beforeFilter('@find', ['only' => ['show','update','edit','destroy']]);
	}

	public function find(Route $route){
		$this->dominio = Dominios::find($route->getParameter('dominios'));
	}
	
	public function index(){
		$dominios = Dominios::paginate(3);;
		return view('dominios.list', compact('dominios'));
	}

	public function create(){
		$dominio = "";
		$clientes = Clientes::all();
		$empresas_proveedoras = EmpresasProveedoras::all();
		return view('dominios.create', compact('dominio','clientes','empresas_proveedoras'));
	}

	public function store(Request $request){
		$dominio = Dominios::create($request->all());
		Session::flash('mensaje', 'Dominio creado exitosamente');
		return redirect('/proyectos/create');
	}

	public function show($id){
		return view('dominios.detalle', ['dominio'=>$this->dominio]);
	}

	public function edit($id){
		return view('dominios.create', ['dominio'=>$this->dominio]);
	}

	public function update($id){
		//
	}

	public function destroy($id)
	{
		//
	}

}
