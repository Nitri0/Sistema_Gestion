<?php namespace App;

use App\Http\Controllers\ConfiguracionController;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract {

	use Authenticatable,Authorizable, CanResetPassword;

		//agregar roles de usuario en esta tabla
	protected $connection = 'permisologia';
	protected $table = 't_usuario';
	protected $primaryKey = "id_usuario";
	protected $fillable = ['correo_usuario', 'password','id_permisologia','habilitado_usuario', 'codigo_activacion', 'activado_usuario', 'tutorial'];
	protected $hidden = ['password', 'remember_token'];
	public $timestamps = false;
	


	protected $appends = ['permisos','empresa'];

	public function perfil(){
		return $this->hasOne('App\Perfil','id_usuario');
	}
	public function getPermisosAttribute(){
        Excepciones::where('id_usuario', $this->id_usuario)
        				->get(['modulo_excepcion']);
    }

	public function getNombreEmpresaAttribute(){

		$relacion = MMEmpresasUsuarios::where('id_usuario',$this->id_usuario)->first();
		if ($relacion){
			$empresa = Empresas::find($relacion->id_empresa)->first();
			if($empresa){
				return (string) $empresa;
			}
		};
		return false;

        Empresas::where('id_usuario', $this->id_usuario)
        				->get(['nombre_empresa','rif_empresa']);

    }

  //   public function getPermisosMenu(){
  //   	$configuracion = new ConfiguracionController();
  //   	$dicc = $configuracion->InfoModulos;
		// $items = [];
		// $menu = [];
		// $modulos = Excepciones::where('id_usuario', $this->id_usuario)
  //   						->get();
  //   	foreach($modulos as $modulos_raw){
  //   		$modulo = explode(".", $modulos_raw->modulo_excepcion);
  //   		$labels = $dicc[$modulo[0]];


  //   		if (!array_key_exists($modulo[0],$items)){
	 //    		$items[$modulo[0]] = [	
	 //    						'nombre_modulo' => $modulo[0],
		// 						'nombre_menu' => $labels['nombre_menu'],
		// 						'icon'=> $labels['icon'],
		// 						'submenu' =>[],
	 //    							];
	 //    	}
	 //    	//dd($modulo[1], $labels['items_menu']);
  //   		if (array_key_exists($modulo[1], $labels['items_menu'])){
	 //    		$submenu = [
		// 			'label'=>$labels['items_menu'][$modulo[1]]['nombre'],
		// 			'url'=>$labels['items_menu'][$modulo[1]]['url'],
  //   			];
	 //    		array_push($items[$modulo[0]]['submenu'], $submenu);
  //   		}
  //   	}
  //   	return json_encode($items);
  //   }

  //   public function getAllPermisosMenu(){
  //   	$configuracion = new ConfiguracionController();
  //   	$dicc = $configuracion->InfoModulos;

		// foreach ($dicc as $raw_name => $modulo) {

		// 	$items[$raw_name] = [
		// 						'nombre_modulo' => $raw_name,
		// 						'nombre_menu' => $modulo['nombre_menu'],
		// 						'icon'=> $modulo['icon'],
		// 						'submenu' =>[],
	 //    							];
	 //    	foreach ($modulo['items_menu'] as $key => $submenu) {
	 //    		$submenu = [
		// 			'label'=>$submenu['nombre'],
		// 			'url'=>$submenu['url'],
  //   			];
	 //    		array_push($items[$raw_name]['submenu'], $submenu);
	 //    	}
		// }
  //   	return json_encode($items);
  //   }

	public function getPerfil(){
		$perfil = Perfil::where('id_usuario',$this->id_usuario)->first();
		return $perfil;
	}	

	public function fullName(){
		$perfil = Perfil::where('id_usuario',$this->id_usuario)->first();
		if($perfil){
			return $perfil->fullName();
		}
		return $this->correo_usuario;
	}

	public function getFullName(){
		return Perfil::where('id_usuario',$this->id_usuario)->first()->fullName();
	}


	public function getIdEmpresa(){
		//busqueda si es un usuario Registrado por un administrador (no el usuario principal de la empresa)
		$relacion = MMEmpresasUsuarios::where('id_usuario',$this->id_usuario)->first();
		if ($relacion){
			return $relacion->id_empresa;
		};
		//busqueda si es el administrador de la cuenta
		$empresa = Empresas::where('id_usuario',$this->id_usuario)->first();
		if ($empresa){
			return $empresa->id_empresa;
		}

	}


	public function getHabiltiadoEmpresa(){

		$relacion = MMEmpresasUsuarios::where('id_usuario',$this->id_usuario)->first();
		if (!$relacion){
			return false;
		}
		$empresa = Empresas::find($relacion->id_empresa);
		if (!$empresa){
			return false;
		}
		return $empresa->habilitado_empresa;
	}

	public function isAdmin(){
		$permisologia = Permisologia::find($this->id_permisologia);
		if ($permisologia){
			return $permisologia->id_permisologia == 2;
		}
		return false;
	}

	public function isSuperAdmin(){
		$permisologia = Permisologia::find($this->id_permisologia);
		if ($permisologia){
			return $permisologia->id_permisologia == 5;
		}
		return false;
	}

	public function isSocio(){
		$permisologia = Permisologia::find($this->id_permisologia);
		if ($permisologia){
			return $permisologia->id_permisologia == 3;
		}
		return false;
	}

	public function isTrabajador(){
		$permisologia = Permisologia::find($this->id_permisologia);
		if ($permisologia){
			return $permisologia->id_permisologia == 1;
		}
		return false;
	}

	// public function validacionVencimiento(){
	// 	$id_empresa = MMEmpresasUsuarios::where('id_usuario',$this->id_usuario)->first()->id_empresa;
	// 	$empresa = Empresas::find($id_empresa);
	// 	//dd($empresa->created_at);
	// 	//subDays
	// 	$fecha_creacion = \Carbon\Carbon::parse($empresa->created_at);
	// 	//dd($fecha_creacion >= \Carbon\Carbon::now()->subDays(7), $fecha_creacion, \Carbon\Carbon::now()->subDays(7));

	// 	if ($empresa){
	// 		if ($empresa->suscriptor_empresa == 1){
	// 			return false;
	// 		}
	// 		return $empresa->suscriptor_empresa == 0 && $fecha_creacion < \Carbon\Carbon::now()->subDays(7);
	// 	}
	// 	return true;
	// }

	public function puedeAgregarUsuarios(){
		$id_empresa = MMEmpresasUsuarios::where('id_usuario',$this->id_usuario)->first()->id_empresa;
		$cantidad = MMEmpresasUsuarios::where('id_empresa',$id_empresa)->count();
		$empresa = Empresas::find($id_empresa);
		// dd($empresa , $empresa->suscriptor_empresa, $cantidad < $empresa->cantidad_usuarios );
		if ($empresa && $empresa->suscriptor_empresa && $cantidad < $empresa->cantidad_usuarios ){
			return true;
		}
		return false;
	}



	public function validacionExcepciones($method){
		
		$excepciones = Excepciones::where('id_usuario', $this->id_usuario)
								->where('id_empresa', $this->getIdEmpresa())
								->where('modulo_excepcion',$method)
								->first();
		//dd($method, $excepciones);
		if ($excepciones){
			return true;
		}
		return false;
	 }

	 public function tiene_permiso($value){

	 	if ($this->isAdmin()){
	 		return true;
	 	}else{
	 		//BUSCAR LA MANERA DE FILTRAR POR TODOS LOS MODULOS
			$excepciones = Excepciones::where('id_usuario',$this->id_usuario)
									->where('modulo_excepcion',$value.'.index')
									->first();

			if($excepciones){
				return true;
			}
			return false;
	 	}
	 }
}
