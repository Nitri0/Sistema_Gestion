<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class MMEmpresasUsuarios extends Model {

	protected $table = 't_usuarios_empresas';
	protected $primaryKey = "id_usuarios_empresas";
	public $timestamps = false;
	
	protected $fillable = array('id_usuario',
								'id_empresa');


}

