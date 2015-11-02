<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Dominios;
use App\Clientes;
use App\EmpresasProveedoras;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Session;

class DominiosController extends Controller {

	public function __construct(){
		$this->beforeFilter('@find', ['only' => ['show','update','edit','destroy']]);
	}

	public function find(Route $route){
		$this->dominio = Dominios::find($route->getParameter('dominios'));
	}
	
	public function index(){
		$dominios = Dominios::orderBy('id_dominio', 'desc')->paginate(10);;
		return view('dominios.list', compact('dominios'));
	}

	public function create(){
		$dominio = "";
		$empresas_proveedoras = EmpresasProveedoras::all();
		return view('dominios.create', compact('dominio', 'empresas_proveedoras'));
	}

	public function store(Request $request){
		$dominio = Dominios::create($request->all());
		Session::flash('mensaje', 'Dominio creado exitosamente');
		return redirect('/dominios');
	}

	public function show($id){
		return view('dominios.detalle', ['dominio'=>$this->dominio]);
	}

	public function edit($id){
		$dominio = (string) Dominios::find($id);
		$empresas_proveedoras = EmpresasProveedoras::all();
		return view('dominios.create', compact('dominio','empresas_proveedoras'));
	}

	public function update($id, Request $request){
		Dominios::find($id)->update($request->all());
		Session::flash('mensaje', 'Dominio editado exitosamente');
		return redirect("/dominios");
	}

	public function destroy($id)
	{
		//
	}

}
