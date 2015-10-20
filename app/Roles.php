<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model {

	protected $table = "t_rol_usuario";
	protected $primaryKey = "id_rol_usuario";
	protected $fillable = array('id_usuario',
								'id_proyecto',
								'id_tipo_rol',
								);
	public $timestamps = false;

}
