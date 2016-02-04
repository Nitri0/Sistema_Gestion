<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Etapas;
use App\GrupoEtapas;
use Session;
use Illuminate\Routing\Route;
use Illuminate\Http\Request;
use Gate;
use Auth;

class EtapasController extends Controller {

	public function __construct(){
		$this->beforeFilter('@permisos');
		$this->beforeFilter('@find', ['only' => ['show','update','edit','destroy']]);
	}

	public function find(Route $route){
		$this->grupo_etapas = GrupoEtapas::where('id_grupo_etapas',$route->getParameter('tipo_proyectos'))
									->where('id_empresa', Auth::user()->getIdEmpresa())
									->where('habilitado_grupo_etapas',1)

									->first();

		if(!$this->grupo_etapas){
			return redirect('/tipo_proyectos');
		};
	}

	public function permisos(Route $route){
		if(Gate::denies('tipo_proyectos', $route->getName()) ){
			Session::flash("mensaje-error","No tiene permisos para acceder al modulo: ".$route->getName());
			return redirect('/mis-proyectos');
		};
	}

	public function index(){
		$grupo_etapas = GrupoEtapas::where('id_empresa',Auth::user()->getIdEmpresa())
										->orderBy('id_grupo_etapas','desc')
										->where('habilitado_grupo_etapas',1)
										->get();
		return view('etapas.list',compact('grupo_etapas'));
	}

	public function create(){
		return view('etapas.create');
	}


	public function store(Request $request){
		$request['id_usuario'] = Auth::user()->id_usuario;
		$request['id_empresa'] = Auth::user()->getIdEmpresa();
		
		$grupoEtapas = GrupoEtapas::create($request->all());
		

		if ($request->cantidad_etapas>0){
			foreach (range(0, $request->cantidad_etapas-1) as $index) {
				Etapas::create(['nombre_etapa' => $request['nombre_etapa_'.$index],
							   'numero_orden_etapa' => $index+1,
							   'id_grupo_etapas' => $grupoEtapas->id_grupo_etapas]);

				};
		};
		
		Session::flash('mensaje', 'Grupo de etapas creado exitosamente');
		return json_encode(['success'=>true,]);
	}


	public function show($id){

		return view('etapas.detalle', ['grupo_etapas'=>$this->grupo_etapas,]);
	}


	public function edit($id)
	{
		//
	}


	public function update($id)
	{
		//
	}


	public function destroy($id){
		$this->grupo_etapas->fill(['habilitado_grupo_etapas'=>0,]);
		$this->grupo_etapas->save();
		return redirect('/tipo_proyectos');
	}

}
