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
								'espacio_asignado_dominio',
								'habilitado_dominio',
								'id_empresa',
								'id_usuario');
	//protected $dates = ['fecha_creacion_dominio'];

	protected $appends = ['nombre_cliente','nombre_proyecto','nombres_empresa_proveedora'];

	public function getFechaCreacionDominioAttribute(){
		$date = \Carbon\Carbon::parse($this->attributes['fecha_creacion_dominio']); 
	  	return $date->format('d/m/Y');

	//    return $this->attributes['fecha_creacion_plantilla'];
	}

	public function getNombreClienteAttribute(){
		$proyecto = Proyectos::where('id_proyecto',$this->attributes['id_proyecto'])->first();

		if ($proyecto){
			$cliente = Clientes::where('id_cliente',$proyecto->id_cliente)->first();
			if ($cliente){
				return $cliente->nombre_cliente;
			}
		}
	  	return "";
	}

	public function getNombreProyectoAttribute(){
		$proyecto = Proyectos::where('id_proyecto',$this->id_proyecto)->first();
		if ($proyecto){
			return $proyecto->nombre_proyecto;
		}
	  	return "";
	}

	public function getNombresEmpresaProveedoraAttribute(){
		$empresasP = EmpresasProveedoras::find($this->attributes['id_empresa_proveedora']);
		if ($empresasP){
			return $empresasP->nombres_empresa_proveedora;
		}
	  	return "";
	}


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
