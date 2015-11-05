<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model {

	protected $table = "t_clientes";
	protected $primaryKey = "id_cliente";
	protected $fillable = array('nombre_cliente',
								'email_cliente',
								'persona_contacto_cliente',
								'ci_rif_cliente',
								'telefono_cliente',
								'telefono_2_cliente',
								'direccion_cliente');
	public $timestamps = false;

	public function getProyecto(){
		$proyecto = Proyectos::where('id_Cliente',$this->id_cliente)->first();
		if ($proyecto){
			return $proyecto->nombre_proyecto;	
		}
		return "Cliente no asociado";
	}


	public function hasProyecto(){
		$proyecto = Proyectos::where('id_cliente',$this->id_cliente)->first();
		if ($proyecto){
			return true;	
		}
		return false;
	}	

}
