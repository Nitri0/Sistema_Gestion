<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class EmpresasProveedoras extends Model {

	protected $table = "t_empresa_proveedora";
	protected $primaryKey = "id_empresa_proveedora";
	public $timestamps = false;
	protected $fillable = array('nombres_empresa_proveedora',
								'telefono_empresa_proveedora',
								'id_usuario',
								'id_empresa',
								);

}
