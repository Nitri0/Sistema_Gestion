<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividades extends Model {
	
    protected $table = "t_actividades";
	protected $primaryKey = "id_actividad";
	protected $fillable = array(
		'nombre_actividad',
		'estatus_actividad',
		'descripcion_contacto_actividad',
		'autor_actividad',
		'fecha_inicio_actividad',
		'fecha_aproximada_entrega_actividad',
		'fecha_entrega_actividad',
		'id_proyecto',
		'habilitado'
	);
	public function usuarios_actividades(){
		return $this->belongsToMany('App\Usuario','usuarios_actividades','id_usuario','id_actividad');
	}
	public function proyecto(){
		return $this->belongsTo('App\Proyecto','id_proyecto');
	}
}
