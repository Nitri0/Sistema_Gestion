<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Clientes;
use App\Avances;
use Session;
use redirect;
//use Carbon\Carbon;

class AvancesController extends Controller {

	public function __construct(){
		$this->beforeFilter('@find', ['only' => ['show','update','edit','destroy']]);
	}

	public function find(Route $route){
		$this->avance = Proyectos::find($route->getParameter('avances'));
	}

	public function index(){
		$avances = Avances::paginate(3);
		return view('avances.list', compact('avances'));
	}

	public function create(){
		$avance = "";
		$clientes = Clientes::all();
		return view('avances.create', ['avance'=>$this->avance,
									   'clientes'=>$clientes]);
	}

	public function store(Request $request){
		//$request["fecha_avance"] = Carbon::now();
		$avances = Avances::create($request->all());
		Session::flash('mensaje', 'Avance creado exitosamente');
		return redirect('/avances');
	}

	public function show($id){
		return view('avances.detalle', ['avance'=>$this->avance]);
	}

	public function edit($id){
		return view('avances.create', ['avance'=>$this->avance]);
	}

	public function update($id, Request $request){
		$this->avance->update($request->all());
		Session::flash('mensaje', 'Avances editado exitosamente');
		return redirect("/avances");
	}

	public function destroy($id)
	{
		//
	}

}
