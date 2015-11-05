<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Avances extends Model {

	protected $table = "t_avances";
	protected $primaryKey = "id_avance";
	public $timestamps = false;
	protected $fillable = array('id_proyecto',
								'id_etapa',
								'id_usuario',
								'asunto_avance',
								'descripcion_avance',
								'check_copia_cliente_avance',
								);


	protected $dates = ['fecha_creacion_avance'];


	public function getNombreCreador(){
		$usuario = User::find($this->id_usuario);
		if ($usuario){
			return $usuario->getFullName();	
		};
		return "Usuario no existente";
	}

}
