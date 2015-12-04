<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use App\Clientes;
use App\TipoRoles;
use Session;
use redirect;
use Gate;
use Auth;


class RolesController extends Controller {

	public function __construct(){
		$this->beforeFilter('@permisos');
		$this->beforeFilter('@find', ['only' => ['show','update','edit','destroy']]);
	}

	public function find(Route $route){
		$this->rol = TipoRoles::where('id_tipo_rol',$route->getParameter('roles'))
									->where('id_empresa', Auth::user()->getIdEmpresa())
									->first();
		if(!$this->rol){
			Session::flash('mensaje-error', 'No puede acceder ese registro');
			return redirect('/roles');
		}
	}

	public function permisos(Route $route){
		if(Gate::denies('roles', $route->getName()) ){
			Session::flash("mensaje-error","No tiene permisos para acceder al modulo: ".$route->getName());
			return redirect('/mis-proyectos');
		};
	}

	public function index(){
		//dd(Auth::user()->getIdEmpresa());
		$roles = json_encode( TipoRoles::where('id_empresa', Auth::user()->getIdEmpresa()) 
								->orderBy('id_tipo_rol', 'desc')
								->get() );
		return view('roles.list', compact('roles'));
	}

	public function create(){
		$rol = "";
		return view('roles.create', compact('rol'));
	}

	public function store(Request $request){
		$request['id_usuario'] = Auth::user()->id_usuario;
		$request['id_empresa'] = Auth::user()->getIdEmpresa();
		TipoRoles::create($request->all());
		Session::flash('mensaje', 'Rol creado exitosamente');
		return redirect('/roles');
	}

	public function show($id){
		return view('roles.detalle',['rol'=>$this->rol]);
	}

	public function edit($id){
		return view('roles.create',['rol'=>$this->rol]);
	}

	public function update($id, Request $request){

		$this->rol->fill(['id_usuario'=>Auth::user()->id_usuario,
					 'descripcion_tipo_rol'=>$request->descripcion_tipo_rol,
					 'nombre_tipo_rol'=>$request->nombre_tipo_rol]);
		$this->rol->save();
		Session::flash('mensaje', 'Rol editado exitosamente');
		return redirect("/roles");
	}

	public function destroy($id){
		Clientes::find($id)->delete();
		return redirect("/roles");
	}
}
