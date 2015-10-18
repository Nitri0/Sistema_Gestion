<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Avances extends Model {

	protected $table = "t_detalle_avance";
	protected $primaryKey = "id_detalle_avance";
	public $timestamps = false;
	protected $fillable = array('notificacion_avance',
								'id_cliente',
								'descripcion_avance',
								'fecha_avance',
								);


	public function nombre_cliente(){
		$cliente = Clientes::find($this->id_cliente);
		if ($cliente){
			return $cliente->nombre_cliente;	
		}
		return "cliente no existente";
	}

}
