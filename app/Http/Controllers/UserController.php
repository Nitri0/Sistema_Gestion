<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\Perfil;
use Illuminate\Http\Request;

class UserController extends Controller {


	public function perfil(Request $request){
		$perfil = Perfil::where('id_usuario', $request->user()->id_usuario)->first();
		return view('user.perfil',['perfil'=>$perfil]);
	}

	public function postPerfil(Request $request){
		Perfil::where('id_usuario', $request->user()->id_usuario)->update($request->all());
		return redirect("/gestion");
	}
}
