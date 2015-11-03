<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Proyectos;

class Dominios extends Model {

	protected $table = "t_dominios";
	protected $primaryKey = "id_dominio";
	public $timestamps = false;
	protected $fillable = array('nombre_dominio',
								'id_empresa_proveedora',
								'id_proyecto',
								'fecha_dominio',
								'habilitado_dominio'
								);


	public function getProyecto(){
		$proyecto = Proyectos::find($this->id_proyecto);
		if ($proyecto){
			return $proyecto;
		};
	}

	public function empresaProveedora(){
		$proveedor = EmpresasProveedoras::find($this->id_empresa_proveedora);
		if ($proveedor){
			return $proveedor->nombres_empresa_proveedora;	
		}
		return "cliente no existente";
	}
}
