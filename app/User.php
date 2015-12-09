<?php namespace App;

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
	protected $fillable = ['correo_usuario', 'password','id_permisologia','habilitado_usuario'];
	protected $hidden = ['password', 'remember_token'];
	public $timestamps = false;


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
	

	public function validacionExcepciones($method){
		$excepciones = Excepciones::where('id_usuario', $this->id_usuario)
								->where('id_empresa', $this->getIdEmpresa())
								->where('modulo_excepcion',$method)
								->first();

		if ($excepciones){
			return true;
		}
		return false;
	 }
	// public function validacionExcepciones($method){
	// 	Excepciones::where('id_usuario', $this->id_usuario)
	// 					->where('id_empresa', $this->getIdEmpresa())
	// 					->where('modulo_excepcion',$method)
	// 					->fi
	// 				->get()->pluck('modulo_excepcion')->toArray();
	// 	return $user->getIdEmpresa() == 
	// }

}
