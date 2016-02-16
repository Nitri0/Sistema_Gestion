<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Tipo;
use App\Perfil;

class Roles extends Model {

	protected $table = "t_rol_usuario";
	protected $primaryKey = "id_rol_usuario";
	protected $fillable = array('id_usuario',
								'id_proyecto',
								'id_tipo_rol',
								'id_empresa');
	public $timestamps = false;


	public function usuario(){
		return $this->belongsTo('App\User','id_usuario');
	}
	public function getRolName(){
		return TipoRoles::find($this->id_tipo_rol)->nombre_tipo_rol;
	}

	public function getUser(){
		return User::find($this->id_usuario);
	}


}
