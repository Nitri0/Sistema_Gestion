<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Master extends Model {

	protected $table = 't_maestro';
	protected $primaryKey = "id_maestro";
	public $timestamps = false;
	
	protected $fillable = array('nombre_maestro');

}
