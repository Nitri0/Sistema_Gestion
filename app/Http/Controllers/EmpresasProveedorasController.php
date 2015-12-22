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
		$this->beforeFilter('@find', ['only' => ['show','update','edit','destroy']]);
	}

	#______________________________ Filtros _________________________________
	public function find(Route $route){
		$this->empresa_proveedora = EmpresasProveedoras::where('id_empresa_proveedora',$route->getParameter('empresas_proveedoras'))
									->where('id_empresa', Auth::user()->getIdEmpresa())
									->first();

		if(!$this->empresa_proveedora){
			Session::flash('mensaje-error', 'No puede acceder ese registro');
			return redirect('/empresas_proveedoras');
		}	
	}

	public function permisos(Route $route){
		if(Gate::denies('empresasProveedoras', $route->getName()) ){
			Session::flash("mensaje-error","No tiene permisos para acceder al modulo: ".$route->getName());
			return redirect('/mis-proyectos');
		};
	}

	#______________________________ Metodos _________________________________
	public function index(){
		$empresas_proveedoras = EmpresasProveedoras::where('id_empresa',Auth::user()->getIdEmpresa())
													->where('habilitado_empresa_proveedora', 1)
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
		return redirect('/empresas_proveedoras');
	}

	public function show($id){
		return view('empresas_proveedoras.detalle', ['empresa_proveedora'=>$this->empresa_proveedora]);
	}

	public function edit($id){
		return view('empresas_proveedoras.create', ['empresa_proveedora'=>$this->empresa_proveedora]);
	}

	public function update(Request $request, $id){
		//dd($request->all());
		$this->empresa_proveedora->fill($request->except('_method'));
		$this->empresa_proveedora->save();
		//dd($this->empresa_proveedora);
		Session::flash('mensaje', 'Empresa proveedora actalizado exitosamente');
		return redirect('/empresas_proveedoras');
	}


	public function destroy($id){
		$this->empresa_proveedora->fill(['habilitado_empresa_proveedora'=>0,]);
		$this->empresa_proveedora->save();
		Session::flash('mensaje', 'Empresa proveedora eliminada exitosamente');
		return redirect('/empresas_proveedoras');
	}

}
