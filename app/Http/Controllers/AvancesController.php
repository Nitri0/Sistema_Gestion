<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Clientes;
use App\Avances;
use Session;
use redirect;

use Carbon\Carbon;

class AvancesController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(){
		$avances = Avances::paginate(3);
		return view('avances.list', compact('avances'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(){
		$avance = "";
		$clientes = Clientes::all();
		return view('avances.create', compact('avance','clientes'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request){
		$request["fecha_avance"] = Carbon::now();
		$avances = Avances::create($request->all());
		Session::flash('mensaje', 'Avance creado exitosamente');
		return redirect('/avances');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id){
		$avances = Avances::find($id);
		return view('avances.detalle', compact('avances'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id){
		$avances = Avances::find($id);
		return view('avances.create', compact('avances'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request){
		$avances = Avances::find($id)->update($request->all());
		Session::flash('mensaje', 'Avances editado exitosamente');
		return redirect("/avances");
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
