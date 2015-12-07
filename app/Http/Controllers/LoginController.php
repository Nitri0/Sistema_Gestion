<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Auth;
use Session;
use Redirect;
use App\User;
use App\Perfil;
use Illuminate\Http\Request;

class LoginController extends Controller {


	public function login(){
		return view('autenticacion.login');
	}


	public function postLogin(LoginRequest $request){

	    $user = array(
	        'correo_usuario' => \Input::get('correo_usuario'),
	        'password' => \Input::get('clave_usuario')
	    );

	    $habilitado = User::where('correo_usuario', \Input::get('correo_usuario'))
				    		->where('habilitado_usuario', 1)
				    		->first();

		if (Auth::attempt($user)){
			// $usuario = User::where('correo_usuario', \Input::get('correo_usuario'))->first();
			// if ($usuario->habilitado_usuario==0){
			// 	Session::flash('mensaje-error', 'Usuario deshabilitado.');
			// 	Auth::logout($usuario);
			// 	return redirect("/login");
			// }
				
			return redirect("/mis-proyectos");
			//return redirect()->back();
		}
		Session::flash('mensaje-error', 'Credenciales incorrectas, intentalo de nuevo.');
		return redirect("/login");
		//return $request->correo_usuario;
	}

	public function logout(){
		Auth::logout();
		return Redirect('/login');
	}

}
