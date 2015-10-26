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

		if (Auth::attempt($user)){
			$usuario = User::where('correo_usuario', \Input::get('correo_usuario'))->first();
			Auth::login($usuario);
			return redirect("/mis-proyectos");
			//return redirect()->back();
		}
		Session::flash('mensaje-error', 'Credenciales incorrectas, intentalo de nuevo.');
		return redirect("/login");
		//return $request->correo_usuario;
	}


	public function registro(){
		return view('autenticacion.registro');
	}


	public function postRegistro(Request $request){
		$request['password'] = \Hash::make($request['password']);
		$user = User::create($request->all());
		$perfil = Perfil::create(['id_usuario'=>$user->id_usuario]);
		return Redirect('/login');
	}

	public function logout(){
		Auth::logout();
		return Redirect('/login');
	}

}
