<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model {

	protected $table = "t_tipo";
	protected $primaryKey = "id_tipo";
	protected $fillable = array('id_maestro','nombre_tipo');
	public $timestamps = false;




}
