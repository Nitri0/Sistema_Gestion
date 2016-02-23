<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoProyectos extends Model{

	protected $table = "t_tipo_proyecto";
	protected $primaryKey = "id_tipo_proyecto";
	protected $fillable = array('nombre_tipo_ptoyecto');
	public $timestamps = false;
}
