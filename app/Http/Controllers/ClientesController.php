<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use App\Clientes;
use Session;
use redirect;


class ClientesController extends Controller {

	public function __construct(){
		$this->beforeFilter('@find', ['only' => ['show','update','edit','destroy']]);
	}

	public function find(Route $route){
		$this->cliente = Clientes::find($route->getParameter('clientes'));
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
		return redirect('/proyectos/create');
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

}
