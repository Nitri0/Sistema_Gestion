<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\EmpresasProveedoras;
use Illuminate\Http\Request;
use Session;

class EmpresasProveedorasController extends Controller {

	public function index(){
		$empresas_proveedoras = EmpresasProveedoras::paginate(3);;
		return view('empresas_proveedoras.list', compact('empresas_proveedoras'));
	}

	public function create(){
		$empresa_proveedora = "";
		return view('empresas_proveedoras.create', compact('empresa_proveedora'));
	}

	public function store(Request $request){
		$empresa_proveedora = EmpresasProveedoras::create($request->all());
		Session::flash('mensaje', 'Empresa proveedora creada exitosamente');
		return redirect('/dominios/create');
	}

	public function show($id){
		$empresa_proveedora = EmpresasProveedoras::find($id);
		return view('empresas_proveedoras.detalle', compact('empresa_proveedora'));
	}

	public function edit($id){
		$empresa_proveedora = EmpresasProveedoras::find($id);
		return view('empresas_proveedoras.create', compact('empresa_proveedora'));
	}

	public function update($id){
		//
	}


	public function destroy($id)
	{
		//
	}

}
