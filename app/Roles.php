<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Tipo;

class Roles extends Model {

	protected $table = "t_rol_usuario";
	protected $primaryKey = "id_rol_usuario";
	protected $fillable = array('id_usuario',
								'id_proyecto',
								'id_tipo_rol');
	public $timestamps = false;


	public function getRolName(){
		return Tipo::find($this->id_tipo_rol)->nombre_tipo;
	}

}
