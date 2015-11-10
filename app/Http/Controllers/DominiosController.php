<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Dominios;
use App\Clientes;
use App\Proyectos;
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
		$proyecto = "";
		$empresas_proveedoras = EmpresasProveedoras::all();
		$proyectos = Proyectos::where('usable_proyecto',1)->get();
		return view('dominios.create', compact('dominio', 'empresas_proveedoras', 'proyectos','proyecto'));
	}

	public function store(Request $request){

		Session::flash('mensaje', 'Dominio creado exitosamente');
		if($request->has('id_proyecto')){
			Proyectos::find($request->id_proyecto)->update(['usable_proyecto'=>0,]);		
			$dominio = Dominios::create($request->all());
		}
		$dominio = Dominios::create($request->except('id_proyecto'));
		return redirect('/dominios');
	}

	public function show($id){


		return view('dominios.detalle', ['dominio'=>$this->dominio]);
	}

	public function edit($id){
		$dominio = Dominios::find($id);
		$proyecto = "";
		if ($dominio->id_proyecto){
			$proyecto = Proyectos::find($dominio->id_proyecto);	
		}
		$empresas_proveedoras = EmpresasProveedoras::all();
		$proyectos = Proyectos::where('usable_proyecto',1)->get();
		return view('dominios.create', compact('dominio','empresas_proveedoras','proyectos','proyecto'));
	}

	public function update($id, Request $request){
		Dominios::find($id)->update($request->all());
		if ($request->has('id_proyecto')){
			Proyectos::find($request->id_proyecto)->update(['usable_proyecto'=>0,]);
		}
		Session::flash('mensaje', 'Dominio editado exitosamente');
		return redirect("/dominios");
	}

	public function destroy($id){
		Dominios::find($id)->delete();
		return redirect("/dominios");
	}

	public function actualizarEspacioUsado(){
		$dominios = Dominios::all();
		foreach ($dominios as $dominio) {
			$ruta = '/home/keypan5/public_html/'.$dominio->nombre_dominio;
			if (is_dir($ruta)){
				 $size =  Helper::folderSize( $ruta );	
			}
			$size = -1;
			$dominio->espacio_utilizado;
			$dominio->save();
		}
		return redirect("/dominios");
	}
}
