<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Dominios extends Model {

	protected $table = "t_dominios";
	protected $primaryKey = "id_dominio";
	public $timestamps = false;
	protected $fillable = array('nombre_dominio',
								'id_empresa_proveedora',
								'fecha_dominio',
								'habilitado_dominio'
								);


	public function nombreCliente(){
		$cliente = Clientes::find($this->id_cliente);
		if ($cliente){
			return $cliente->nombre_cliente;	
		}
		return "cliente no existente";
	}

	public function empresaProveedora(){
		$proveedor = EmpresasProveedoras::find($this->id_empresa_proveedora);
		if ($proveedor){
			return $proveedor->nombres_empresa_proveedora;	
		}
		return "cliente no existente";
	}	
}
