<?php namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Routing\Route;
use App\Http\Controllers\Controller;
use App\EmpresasProveedoras;
use App\Empresas;
use Illuminate\Http\Request;
use Session;
use Gate;
use Auth;

class EmpresasProveedorasController extends Controller {

	public function __construct(){
		$this->beforeFilter('@permisos');
		//$this->beforeFilter('@find', ['only' => ['show','update','edit','destroy']]);
	}

	#______________________________ Filtros _________________________________
	public function find(Route $route){
		//$this->cliente = Clientes::find($route->getParameter('clientes'));
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
		if(Gate::denies('empresasProveedoras', $route->getName()) ){
			Session::flash("mensaje-error","No tiene permisos para acceder al modulo: ".$route->getName());
			return redirect('/mis-proyectos');
		};
	}

	#______________________________ Metodos _________________________________
	public function index(){
		$empresas_proveedoras = EmpresasProveedoras::where('id_empresa',Auth::user()->getIdEmpresa() )
													->orderBy('id_empresa_proveedora', 'desc')
													->paginate(10);
		return view('empresas_proveedoras.list', compact('empresas_proveedoras'));
	}

	public function create(){
		$empresa_proveedora = "";
		return view('empresas_proveedoras.create', compact('empresa_proveedora'));
	}

	public function store(Request $request){
		$request['id_usuario'] = Auth::user()->id_usuario;
		$request['id_empresa'] = Auth::user()->getIdEmpresa();
		$empresa_proveedora = EmpresasProveedoras::create($request->all());
		Session::flash('mensaje', 'Empresa proveedora creada exitosamente');
		return redirect('/dominios/create');
	}

	public function show($id){
		$empresa_proveedora = EmpresasProveedoras::where('id_empresa_proveedora',$id)
												 ->where('id_empresa',Auth::user()->getIdEmpresa())->first();
		if($empresas_proveedoras){
			return view('empresas_proveedoras.detalle', compact('empresa_proveedora'));
		}
		Session::flash('mensaje', 'No tiene permisos para ver ese registro');
		return redirect('/empresas_proveedoras');		
	}

	public function edit($id){
		$empresa_proveedora = EmpresasProveedoras::where('id_empresa_proveedora',$id)
												 ->where('id_empresa',Auth::user()->getIdEmpresa())->first();
		if($empresas_proveedoras){
			return view('empresas_proveedoras.create', compact('empresa_proveedora'));
		}
		Session::flash('mensaje', 'No tiene permisos para ver ese registro');
		return redirect('/empresas_proveedoras');
	}

	// public function update($id){
	// 	//
	// }


	// public function destroy($id)
	// {
	// 	//
	// }

}
