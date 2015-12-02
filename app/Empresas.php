<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresas extends Model {

	protected $table = 't_empresas';
	protected $primaryKey = "id_empresa";
	public $timestamps = false;
	
	protected $fillable = array('nombre_empresa',
								'rif_empresa',
								'direccion_empresa',
								'telefono_empresa',
								'correo_empresa',
								'id_usuario',
								);


}

