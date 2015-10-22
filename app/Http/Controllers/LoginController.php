<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Auth;
use Session;
use Redirect;
use App\User;
use Illuminate\Http\Request;
use Closure;
use Illuminate\Contracts\Auth\Guard;

class LoginController extends Controller {


	protected $auth;

	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}	

	public function login(){
		return view('autenticacion.login');
	}

	public function postLogin(LoginRequest $request){

	    $user = array(
	        'correo_usuario' => \Input::get('correo_usuario'),
	        'password' => \Input::get('clave_usuario')
	    );
		//dd($request['clave_usuario'], \Hash::make($request['correo_usuario'] ));

		if ($this->auth->attempt($user)){

			$usuario = User::where('correo_usuario', \Input::get('correo_usuario'))->first();
			$this->auth->login($usuario);
			return redirect("/proyectos");
		}
		return redirect("/");
		//return $request->correo_usuario;
	}

	public function registro(){
		return view('autenticacion.registro');
	}

	public function postRegistro(Request $request){
		$request['clave_usuario'] = \Hash::make($request['clave_usuario']);
		User::create($request->all());
		return Redirect('/login');
	}

	public function logout(){
		$this->auth->logout();
		return Redirect('/proyectos');
	}

	public function show($id){
		//
	}

	public function edit($id){
		//
	}

	public function update($id){
		//
	}

}
