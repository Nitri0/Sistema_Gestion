<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\Tipo;
use App\Master;
use App\Proyectos;
use App\Roles;
use Input;
use App\Perfil;
use Session;
use Illuminate\Http\Request;

class UserController extends Controller {


	public function perfil(Request $request){
		$perfil = Perfil::where('id_usuario', $request->user()->id_usuario)->first();
		return view('user.perfil',['perfil'=>$perfil]);
	}

	public function postPerfil(Request $request){
		Perfil::where('id_usuario', $request->user()->id_usuario)->update($request->all());
		Session::flash('mensaje', 'Perfil actualizado exitosamente');
		return redirect("/gestion");
	}

	public function roles(){
		return view('user.rol');
	}

	public function postRoles(){
		$master = Master::where('nombre_maestro','Roles')->first();
		if(!$master){
			$master = Master::create(['nombre_maestro'=>'Roles']);
		}

		Tipo::create(['id_maestro'  => $master->id_maestro,
					  'nombre_tipo' => Input::get('nombre_tipo')]);

		Session::flash('mensaje', 'Rol creado exitosamente');
		return redirect("proyectos/create");	
	}	

	public function misProyectos(){
		$user = Auth::user();
		//$proyectos_id = Roles::where('id_usuario',$user->id_usuario)->get();
		$proyectos_id = Roles::where('id_usuario','5')->get(['id_proyecto']);
		dd($proyectos_id, $user );
		$proyectos = Proyectos::where('habilitado_proyecto',1)
								->where($proyectos_id)
								->paginate(10);
		return view('user.mis_proyectos.blade.php');
	}
}

