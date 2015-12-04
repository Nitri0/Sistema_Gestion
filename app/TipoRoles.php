<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Tipo;
use App\Perfil;

class TipoRoles extends Model {

	protected $table = "t_tipo_roles";
	protected $primaryKey = "id_tipo_rol";
	protected $fillable = array('id_usuario',
								'nombre_tipo_rol',
								'descripcion_tipo_rol',
								'id_empresa');
	public $timestamps = false;

}
