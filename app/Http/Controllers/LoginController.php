<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Auth;
use Session;
use Redirect;
use App\User;
use App\Empresas;
use App\MMEmpresasUsuarios;
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

	public function registro(){
		return view('autenticacion.registro');
	}

	public function postRegistro(Request $request){
		//dd($request->has('password'));
		if (!$request->has('password') || !$request->has('re_password') || !$request->has('empresa') || !$request->has('identificador')  ){
            Session::flash("mensaje-error",'Rellene todos los campos');
            return redirect("/registro");
        };

		if ($request->password != $request->re_password){
            Session::flash("mensaje-error",'las contraseña no coinciden');
            return redirect("/registrar");
        };        
		if (strlen($request->password) < 8 ){
            Session::flash("mensaje-error",'La contraseña debe tener por lo menos 8 caracteres');
            return redirect("/registrar");
        };        


        $verificacion = User::where('correo_usuario', $request->correo_usuario)->first();

        if ($verificacion){
            Session::flash("mensaje-error","Ese correo electrónico ya está registrado en el sistema.");
            return redirect("/registrar");
        };
        $request['id_permisologia'] = 2;
        $request['password'] = \Hash::make($request['password']);
        $user = User::create($request->all());

        $empresa = Empresas::create(['nombre_empresa'=>$request->empresa,
        							'rif_empresa'=>$request->indentificador,
        						]);
        MMEmpresasUsuarios::create(['id_empresa'=>$empresa->id_empresa,
        							'id_usuario'=>$user->id_usuario,
        						]);
        Perfil::create(['id_usuario'=>$user->id_usuario]);
        Session::flash("mensaje","Usuario registrado exitosamente");
        return redirect('/login');
	}

	public function resetPassword(){
		return view('autenticacion.reset');
	}

	public function postResetPassword(Request $request){

		if ( !$request->get('password') || !$request->get('password_confirmation') ){
			Session::flash("mensaje-error","Debe llenar todos los campos");
			return redirect()->back();
		}

		if ( $request->get('password') != $request->get('password_confirmation') ){
			Session::flash("mensaje-error","Contraseñas no coinciden");
			return redirect()->back();
		}
		$credentials = [
		    'correo_usuario' =>$user = Auth::user()->correo_usuario,
		    'password' => $request->get('old-password'),
		];
		if(\Auth::validate($credentials)) {

		    $user = Auth::user();
		    $user->password = \Hash::make($request['password']);
		    $user->save();
		    Auth::logout();
			Session::flash("mensaje","Cambio de contraseña exitoso, favor loguearse nuevamente");
			return redirect('/login');
		}
		Session::flash("mensaje-error","Contraseña incorrecta incorrectas");

		return redirect()->back();
	}

	public function forgetPassword(){
		return view('autenticacion.password');
	}

	public function postForgetPassword(){
		return view('autenticacion.reset');
	}		

}
