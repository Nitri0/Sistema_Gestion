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
use Gate;

class DominiosController extends Controller {

	public function __construct(){
		$this->beforeFilter('@permisos');
		$this->beforeFilter('@find', ['only' => ['show','update','edit','destroy']]);
	}

	public function find(Route $route){
		$this->dominio = Dominios::find($route->getParameter('dominios'));
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
		if(Gate::denies('dominios', $route->getName()) ){
			Session::flash("mensaje-error","No tiene permisos para acceder al modulo: ".$route->getName());
			return redirect('/mis-proyectos');
		};
	}

	
	public function index(){
		$dominios = json_encode(\DB::table('t_dominios')
				 					->where('t_dominios.habilitado_dominio','=',1)
				 					->leftJoin('t_proyectos', 't_proyectos.id_proyecto', '=', 't_dominios.id_proyecto')
				 					->leftJoin('t_clientes', 't_clientes.id_cliente', '=', 't_proyectos.id_cliente')
				 					->join('t_empresa_proveedora', 't_empresa_proveedora.id_empresa_proveedora', '=', 't_dominios.id_empresa_proveedora')
				 					->orderBy('t_dominios.id_dominio','desc')
				 					->get());

		return view('dominios.list', compact('dominios'));
	}

	public function create(){
		$dominio = "";
		$proyecto = "";
		$empresas_proveedoras = EmpresasProveedoras::all();
		$proyectos = Proyectos::where('usable_proyecto',1)->get();
		$tamanos = ["4294967296"=>"4 GB",
					"2147483648"=>"2 GB",
					"1073741824"=>"1 GB",
					"536870912" =>"512 MB",
					"268435456" =>"256 MB",
					"134217728" =>"128 MB",
					"67108864"  =>"64 MB",
					"33554432"  =>"32 MB",];
		return view('dominios.create', compact('dominio', 'empresas_proveedoras', 'proyectos','proyecto', 'tamanos'));
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
		$tamanos = ["4294967296"=>"4 GB",
					"2147483648"=>"2 GB",
					"1073741824"=>"1 GB",
					"536870912" =>"512 MB",
					"268435456" =>"256 MB",
					"134217728" =>"128 MB",
					"67108864"  =>"64 MB",
					"33554432"  =>"32 MB",
					"0"  =>"0 MB"
					];		
		if ($dominio->id_proyecto){
			$proyecto = Proyectos::find($dominio->id_proyecto);
			if ($proyecto->espacio_asignado_dominio>0){

				$tamanos= [$proyecto->espacio_asignado_dominio=>'Select'] + $tamanos;
			};
		};
		$empresas_proveedoras = EmpresasProveedoras::all();
		$proyectos = Proyectos::where('usable_proyecto',1)->get();
		return view('dominios.create', compact('dominio','empresas_proveedoras','proyectos','proyecto','tamanos'));
	}

	public function update($id, Request $request){
		
		if ($request->has('id_proyecto')){
			Proyectos::find($request->id_proyecto)->update(['usable_proyecto'=>0,]);
			Dominios::find($id)->update($request->all());
		}else{
			Dominios::find($id)->update($request->except('id_proyecto'));
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
		//dd($dominios);
		foreach ($dominios as $dominio) {
			$size = -1;
			$ruta = '/home/keypan5/public_html/'.$dominio->nombre_dominio;

			if (is_dir($ruta)){
				 $size =  Helper::folderSize( $ruta );	
			}
			$dominio->espacio_usado_dominio = $size;
			$dominio->save();
		}
		Session::flash('mensaje', 'Actualizacion exitosa');
		return redirect("/dominios");
	}
}
