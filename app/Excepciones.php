<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Excepciones extends Model
{
		//agregar roles de usuario en esta tabla
	protected $connection = 'permisologia';
	protected $table = 't_excepciones';
	protected $primaryKey = "id_excepcion";
	protected $fillable = ['modulo_excepcion', 'id_usuario'];
	public $timestamps = false;

}
