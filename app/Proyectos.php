<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Roles;

class Proyectos extends Model {

	protected $table = "t_proyectos";
	protected $primaryKey = "id_proyecto";
	protected $fillable = array('id_dominio',
								'id_cliente',
								'nombre_proyecto',
								'estatus_proyecto'
								);
	public $timestamps = false;


	public function getEstatus(){
		$estatus = [
					'Dominio creado',
					'Levantamiento de requerimientos',
					'Maquetacion',
					'Desarrollo de plantilla',
					'Finalizado'
					];

		return $estatus[$this->estatus_proyecto];
	}

	public function getClienteData(){
		# code...
	}


	public function getRol($id_usuario){
		$rol = Roles::where('id_proyecto',$this->id_proyecto)->where('id_usuario', $id_usuario)->first();
		return $rol->getRolName();
	}
}
