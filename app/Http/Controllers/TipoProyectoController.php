<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Etapas;
use App\GrupoEtapas;
use App\TipoProyectos;

use Session;
use Illuminate\Routing\Route;
use Illuminate\Http\Request;
use Gate;
use Auth;

class TipoProyectoController extends Controller {

	public function __construct(){
		$this->beforeFilter('@permisos');
		$this->beforeFilter('@find', ['only' => ['show','update','edit','destroy']]);
	}

	public function find(Route $route){
		$this->tipo_proyectos = TipoProyectos::where('id_tipo_proyecto',$route->getParameter('tipo_proyectos'))
									->where('habilitado_tipo_proyecto', 1)
									->where('id_empresa', Auth::user()->getIdEmpresa())
									->first();
		if(!$this->tipo_proyectos){
			Session::flash('mensaje-error', 'No puede acceder ese registro');
			return redirect('/tipo_proyectos');
		}
	}

	public function permisos(Route $route){
		if(Gate::denies('tipo_proyectos', $route->getName()) ){
			Session::flash("mensaje-error","No tiene permisos para acceder al modulo: ".$route->getName());
			return redirect('/mis-proyectos');
		};
	}

	public function index(){
		$tipo_proyectos = TipoProyectos::where('id_empresa', Auth::user()->getIdEmpresa())
										->where('habilitado_tipo_proyecto', 1)
										->paginate(10);
		return view('tipo_proyectos.list',compact('tipo_proyectos'));
	}

	public function create(){
		return view('tipo_proyectos.create',['tipo_proyecto'=>'']);
	}


	public function store(Request $request){
		$request['id_usuario'] = Auth::user()->id_usuario;
		$request['id_empresa'] = Auth::user()->getIdEmpresa();
		$grupoEtapas = TipoProyectos::create($request->all());

		Session::flash('mensaje', 'Tipo de Proyecto creado exitosamente');
		return redirect('/tipo_proyectos');
	}


	public function show($id){
	}


	public function edit($id){
		return view('tipo_proyectos.create',['tipo_proyecto'=>$this->tipo_proyectos]);
	}


	public function update(Request $request, $id){
		//dd($this->tipo_proyectos);
		//dd($request->nombre_tipo_proyecto);
		$this->tipo_proyectos->fill(['nombre_tipo_proyecto'=>$request->nombre_tipo_proyecto]);
		$this->tipo_proyectos->save();
		return redirect('/tipo_proyectos');
	}


	public function destroy($id){
		
		$this->tipo_proyectos->fill(['habilitado_tipo_proyecto'=>0,]);
		$this->tipo_proyectos->save();
		return redirect('/tipo_proyectos');
	}

}
