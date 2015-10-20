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
		$clientes = Clientes::paginate(3);
		return view('clientes.list', compact('clientes'));
	}

	public function create(){
		$cliente = "";
		return view('clientes.create', compact('cliente'));
	}

	public function store(Request $request){
		Clientes::create($request->all());
		Session::flash('mensaje', 'Cliente creado exitosamente');
		return redirect('clientes');
	}

	public function show($id){
		return view('clientes.detalle',['cliente'=>$this->cliente]);
	}

	public function edit($id){
		return view('clientes.create',['cliente'=>$this->cliente]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request){
		$cliente = Clientes::find($id)->update($request->all());
		Session::flash('mensaje', 'Cliente editado exitosamente');
		return redirect("/clientes");
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id){
		//
	}

}
