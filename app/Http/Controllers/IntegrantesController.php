<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use redirect;
use App\Roles;

class IntegrantesController extends Controller {



	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request){
		Roles::firstOrCreate($request->except('redirect'));
		return redirect($request['redirect']);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id, Request $request)
	{
		Roles::find($id)->delete();
		return redirect($request['redirect']);
	}

}
