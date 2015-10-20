<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyectos extends Model {

	protected $table = "t_proyectos";
	protected $primaryKey = "id_proyecto";
	protected $fillable = array('id_dominio',
								'id_cliente',
								'nombre_proyecto',
								'estatus_proyecto'
								);
	public $timestamps = false;

}
