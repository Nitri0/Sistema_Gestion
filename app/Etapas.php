<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Etapas extends Model {

	protected $table = 't_etapas';
	protected $primaryKey = "id_etapa";
	public $timestamps = false;
	
	protected $fillable = array('nombre_etapa',
								'numero_orden_etapa',
								'fecha_fin_etapa',
								'fecha_inicio_etapa',
								'id_grupo_etapas'
								);

	public function getAvances(){
		return Avances::where('id_etapa',$this->id_etapa)->get();
	}
}
