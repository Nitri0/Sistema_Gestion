<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubActividades extends Model {

    protected $table = "t_sub_actividades";
	protected $primaryKey = "id_sub_actividades";
	protected $fillable = array(
		'nombre_sub_actividad',
		'descripcion_sub_actividad',
		'estatus_sub_actividad',
		'autor_sub_actividad',
		'fecha_inicio_sub_actividad',
		'fecha_entrega_sub_actividad',
		'id_actividad'
	);
}
