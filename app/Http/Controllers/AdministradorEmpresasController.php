<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use App\Clientes;
use App\Empresas;
use App\User;
use App\Perfil;
use App\MMEmpresasUsuarios;
use Session;
use redirect;
use Gate;


class AdministradorEmpresasController extends Controller {

	public function __construct(){
		$this->beforeFilter('@permisos');
		$this->beforeFilter('@find', ['only' => ['show','update','edit','destroy']]);
	}

	public function find(Route $route){
		$this->empresa = Empresas::find($route->getParameter('admin_empresas'));
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
		if(Gate::denies('admin_empresas', $route->getName()) ){
			Session::flash("mensaje-error","No tiene permisos para acceder al modulo: ".$route->getName());
			return redirect('/mis-proyectos');
		};
	}

	public function index(){
		$empresas = json_encode( Empresas::orderBy('id_empresa', 'desc')->get() );
		return view('empresas.list', compact('empresas'));
	}

	public function create(){
		$empresa = "";
		$usuario = "";
		return view('empresas.create', compact('empresa','usuario'));
	}

	public function store(Request $request){

        \DB::beginTransaction();
        try {
			$user = User::create(['correo_usuario' => $request->correo_usuario,
									'password' => \Hash::make($request->password),
									'id_permisologia' => 2,
									]);
			Perfil::create(['id_usuario'=>$user->id_usuario]);
			$request['id_usuario'] = $user->id_usuario;
			$empresa = Empresas::create($request->all());
			// MMEmpresasUsuarios::create(['id_usuario'=>$user->id_usuario,
			// 							'id_empresa'=>$empresa->id_empresa]);
            \DB::commit();
        } catch (Exception $e) {
            \DB::rollback();
        }

		Session::flash('mensaje', 'Empresa creada exitosamente');
		return redirect('/admin_empresas');
	}

	public function show($id){
		return view('empresas.detalle',['empresa'=>$this->empresa]);
	}

	public function edit($id){

		$usuario = User::find($this->empresa->id_usuario);
		//dd($this->empresa);
		return view('empresas.create',['empresa'=>$this->empresa, 'usuario' => $usuario]);
	}

	public function update($id, Request $request){
		$empresa = Empresas::find($id);
		$empresa->fill($request->except('_method','correo_usuario','password'));
		$empresa->save();

		$usuario = User::find($empresa->id_usuario);
		$usuario->correo_usuario = $request->correo_usuario;
		if ($request->password){

			$usuario->password = \Hash::make($request->password);
		}
		$usuario->save();

		Session::flash('mensaje', 'Empresa editada exitosamente');
		return redirect("/admin_empresas");
	}

	public function destroy($id){
		Clientes::find($id)->delete();
		return redirect("/admin_empresas");
	}

}