<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper;
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


		if (Auth::attempt($user)){
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
		if (!$request->has('password') || !$request->has('re_password') || !$request->has('empresa') || !$request->has('apellido') || !$request->has('nombre') ){
            Session::flash("mensaje-error",'Rellene todos los campos');
            return redirect("/registrar");
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
        $request['codigo_activacion'] = substr(md5(uniqid(rand(), true)), 16, 16);
        $user = User::create($request->all());

        $empresa = Empresas::create(['nombre_empresa'=>$request->empresa,
        						]);
        MMEmpresasUsuarios::create(['id_empresa'=>$empresa->id_empresa,
        							'id_usuario'=>$user->id_usuario,
        						]);
        Perfil::create(['id_usuario'=>$user->id_usuario,
        				'nombre_perfil'=>$request->nombre,
        				'apellido_perfil'=>$request->apellido,
        				]);
        //AQUI ENVIAR EL CORREO
        $asunto = "Codigo de activación";
        $plantilla = "emails.private.codigo_activacion";
        $parametros = [
        			'correo_usuario' => $request->nombre." ".$request->apellido,
        			'codigo_activacion' => $request->codigo_activacion,
        		];
        Helper::SendEmailLogout($request->correo_usuario, $request->correo_usuario, $asunto, $plantilla, $parametros);
        Session::flash("mensaje","Usuario registrado exitosamente, revise en su correo electrónico el enlace de activación que hemos enviado.");
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
		Session::flash("mensaje-error","Correo o contraseña incorrectos");

		return redirect()->back();
	}

	public function forgetPassword(){

		return view('autenticacion.password');
	}

	public function postForgetPassword(Request $request){
		if($request->correo){
			$users = User::where('correo_usuario', $request->correo);
			$user = $users->first();
			if(!$user){
				Session::flash('mensaje-error','Correo no existente.');
				return redirect('/recuperar-contraseña');
			}
			$habilitado = $users->where('activado_usuario',0)->first();
			if ($habilitado){
				//AQUI ENVIAR CORREO
		        $asunto = "Codigo de activación";
		        $plantilla = "emails.private.codigo_activacion";
		        $parametros = [
	        			'correo_usuario' => $habilitado->correo_usuario,
	        			'codigo_activacion' => $habilitado->codigo_activacion,
	        		];
        		Helper::SendEmailLogout($habilitado->correo_usuario, $habilitado->correo_usuario, $asunto, $plantilla, $parametros);
				Session::flash('mensaje','Su usuario está desactivado, hemos enviado un correo con su código de activación');
				return redirect('/login');				
			}
			$perfil = Perfil::where('id_usuario', $user->id_usuario)->first();
			$password = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789') , 0 , 10 );
			
			$asunto = "Reestablecer contraseña";
			$plantilla = 'emails.private.forgot_password';
			$parametros = [
						'nombre' => $perfil->fullName(),
						'password' => $password,
						'contacto_email' => env('CONTACT_EMAIL'),
			];

			Helper::SendEmailLogout($request->correo, $perfil->fullName(), $asunto, $plantilla, $parametros);

			$user->password = \Hash::make($password);
			$user->save();
		}else{
			Session::flash('mensaje-error','Introduzca un correo');
			return redirect('/recuperar-contraseña');
		};
		Session::flash('mensaje','Su nueva contraseña a sido enviada a su correo.');
		return redirect('/login');
	}	

	public function HabilitarUsuario($codigo_activacion){
		$usuarios = User::where( 'codigo_activacion', $codigo_activacion );
		if (!$usuarios->count() > 0){
			Session::flash('mensaje-error','Código de activación invalido.');
			return redirect('/login');
		}
		$usuario_habilitados = $usuarios->where('activado_usuario', 0);
		if ( !$usuario_habilitados->first() ){
			Session::flash('mensaje-error','Código de activación usado.');
			return redirect('/login');
		}
		$usuario_habilitados->update(array('activado_usuario' => 1));
		Session::flash('mensaje','Usuario activado, ya puede iniciar sesión.');
		return redirect('/login');
	}

}
