<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Avances extends Model {

	protected $table = "t_avances";
	protected $primaryKey = "id_avance";
	public $timestamps = false;
	protected $fillable = array('id_proyecto',
								'asunto_avance',
								'descripcion_avance',
								'check_copia_cliente_avance',
								);


	public function nombre_cliente(){
		$cliente = Clientes::find($this->id_cliente);
		if ($cliente){
			return $cliente->nombre_cliente;	
		};
		return "cliente no existente";
	}

}
