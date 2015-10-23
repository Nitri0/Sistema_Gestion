<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Proyectos;
use App\Clientes;
use App\Dominios;
use App\User;
use App\Tipo;
use App\Roles;
use App\Master;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Session;

class ProyectosController extends Controller {

	public function __construct(){
		$this->beforeFilter('@find', ['only' => ['show','update','edit','destroy']]);
	}

	public function find(Route $route){
		$this->proyecto = Proyectos::find($route->getParameter('proyectos'));
	}

	public function index(){
		$proyectos = Proyectos::where('habilitado_proyecto',1)->paginate(10);
		return view('proyectos.list',['proyectos'=>$proyectos]);
	}

	public function create(){
		$clientes = Clientes::all();
		$dominios = Dominios::where('habilitado_dominio',1)->get();
		$usuarios = User::all();
		$id_maestro = Master::where('nombre_maestro','Roles')->first()->id_maestro;
		$roles = Tipo::where('id_maestro',$id_maestro)->get();
		return view('proyectos.create',compact('clientes', 'dominios', 'usuarios', 'roles'));
	}

	public function edit($id){
		return view('proyectos.edit', ['proyecto'=>$this->proyecto]);
	}

	public function show($id){
		return view('proyectos.detalle', ['proyecto'=>$this->proyecto]);
	}

	public function store(Request $request){
		//$request["fecha_avance"] = Carbon::now();
		//dd($request->all());
		$proyecto = Proyectos::create($request->all());
		if ($request['id_dominio']){			
		 	Dominios::where('id_dominio',$request['id_dominio'])->update(['habilitado_dominio'=>0]);
		};

		if ($request->cantidad>0){
			foreach (range(0, $request->cantidad-1) as $index) {
				Roles::create(['id_usuario' => $request['id_usuario'.$index],
							'id_tipo_rol' => $request['id_rol'.$index],
							'id_proyecto'=> $proyecto->id_proyecto]);
						};
		};
		
		Session::flash('mensaje', 'Proyecto creado exitosamente');
		return redirect('/proyectos');
	}

	public function update($id, Request $request){
		//$request["fecha_avance"] = Carbon::now();
		Session::flash('mensaje', 'Proyecto creado exitosamente');
		return redirect('/proyectos');
	}	
}
