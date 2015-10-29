<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Etapas;
use App\GrupoEtapas;
use Session;
use Illuminate\Http\Request;

class EtapasController extends Controller {


	public function index(){
		$grupo_etapas = GrupoEtapas::paginate(10);
		return view('etapas.list',compact('grupo_etapas'));
	}

	public function create(){
		return view('etapas.create');
	}


	public function store(Request $request){
		$grupoEtapas = GrupoEtapas::create($request->all());

		if ($request->cantidad_etapas>0){
			foreach (range(0, $request->cantidad_etapas-1) as $index) {
				Etapas::create(['nombre_etapa' => $request['nombre_etapa_'.$index],
							   'numero_orden_etapa' => $index+1,
							   'id_grupo_etapas' => $grupoEtapas->id_grupo_etapas]);

				};
		};
		
		Session::flash('mensaje', 'Grupo de etapas creado exitosamente');
		return redirect('/grupo_etapas');
	}


	public function show($id){
		$grupo_etapas = GrupoEtapas::find($id);
		return view('etapas.detalle', compact('grupo_etapas'));
	}


	public function edit($id)
	{
		//
	}


	public function update($id)
	{
		//
	}


	public function destroy($id)
	{
		//
	}

}
