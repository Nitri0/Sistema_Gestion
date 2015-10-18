<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\EmpresasProveedoras;
use Illuminate\Http\Request;

class EmpresasProveedorasController extends Controller {
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(){
		$empresas_proveedoras = EmpresasProveedoras::paginate(3);;
		return view('empresas_proveedoras.list', compact('empresas_proveedoras'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(){
		$empresa_proveedora = "";
		return view('empresas_proveedoras.create', compact('empresa_proveedora'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request){
		$empresa_proveedora = EmpresasProveedoras::create($request->all());
		return redirect('empresas_proveedoras');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id){
		$empresa_proveedora = EmpresasProveedoras::find($id);
		return view('empresas_proveedoras.detalle', compact('empresa_proveedora'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id){
		$empresa_proveedora = EmpresasProveedoras::find($id);
		return view('empresas_proveedoras.create', compact('empresa_proveedora'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id){
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
