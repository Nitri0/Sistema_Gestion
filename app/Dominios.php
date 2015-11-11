<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Proyectos;
use App\Http\Controllers\Helper;

class Dominios extends Model {

	protected $table = "t_dominios";
	protected $primaryKey = "id_dominio";
	public $timestamps = false;
	protected $fillable = array('nombre_dominio',
								'id_empresa_proveedora',
								'id_proyecto',
								'fecha_dominio',
								'espacio_usado_dominio',
								'habilitado_dominio'

								);
	protected $dates = ['fecha_creacion_dominio'];

	public function getNombreProyecto(){


		$proyecto = Proyectos::find($this->id_proyecto);
		if ($proyecto){
			return $proyecto->nombre_proyecto;
		};
		return "Sin asignar";
	}

	public function getNombreCliente(){
		$proyecto = Proyectos::find($this->id_proyecto);
		if ($proyecto){

			return Clientes::find($proyecto->id_cliente)->nombre_cliente;
		};
		return "Sin asignar";
	}	

	public function empresaProveedora(){
		$proveedor = EmpresasProveedoras::find($this->id_empresa_proveedora);
		if ($proveedor){
			return $proveedor->nombres_empresa_proveedora;	
		}
		return "cliente no existente";
	}

	public function getSizeUsed(){
		$ruta = '/home/keypan5/public_html/'.$this->nombre_dominio;
		if (is_dir($ruta)){
			return Helper::folderSize( $ruta );	
		}
		return "Dominio no encontrado";	
	}
}
