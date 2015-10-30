<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Roles;
use App\Etapas;

class Proyectos extends Model {

	protected $table = "t_proyectos";
	protected $primaryKey = "id_proyecto";
	protected $fillable = array('id_dominio',
								'id_cliente',
								'id_grupo_etapas',
								'nombre_proyecto',
								'estatus_proyecto'
								);
	public $timestamps = false;

	public function getEstatus(){
		$etapa = Etapas::where('id_grupo_etapas',$this->id_grupo_etapas)->
						where('numero_orden_etapa', $this->estatus_proyecto)->first();
		if (!$etapa){
			return "no disponible";
		}
		
		return $etapa->nombre_etapa;
	}

	public function getIdEtapa(){
		$etapa = Etapas::where('id_grupo_etapas',$this->id_grupo_etapas)->
						where('numero_orden_etapa', $this->estatus_proyecto)->first();
		return $etapa->id_etapa;
	}

	public function getClienteData(){
		# code...
	}


	public function getRol($id_usuario){
		$rol = Roles::where('id_proyecto',$this->id_proyecto)->where('id_usuario', $id_usuario)->first();
		return $rol->getRolName();
	}
}
