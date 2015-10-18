<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Dominios;
use App\Clientes;
use App\EmpresasProveedoras;
use Illuminate\Http\Request;

class DominiosController extends Controller {

	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(){
		$dominios = Dominios::paginate(3);;
		return view('dominios.list', compact('dominios'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(){
		$dominio = "";
		$clientes = Clientes::all();
		$empresas_proveedoras = EmpresasProveedoras::all();
		return view('dominios.create', compact('dominio','clientes','empresas_proveedoras'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request){
		$dominio = Dominios::create($request->all());
		//dd($request->all());
		return redirect('dominios');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id){
		$dominio = Dominios::find($id);
		return view('dominios.detalle', compact('dominio'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id){
		$dominio = Dominios::find($id);
		return view('dominios.create', compact('dominio'));
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
