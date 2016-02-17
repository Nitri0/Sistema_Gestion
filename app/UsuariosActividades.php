<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsuariosActividades extends Model
{
    //
    protected $table = "t_usuarios_actividades";
	protected $primaryKey = "id_usuario_actividad";
	protected $fillable = array('id_usuario',
								'id_actividad');
	public $timestamps = false;
}
