<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividades extends Model {
	
    protected $table = "t_actividades";
	protected $primaryKey = "id_actividad";
	protected $fillable = array(
		'nombre_actividad',
		'estatus_actividad',
		'descripcion_actividad',
		'autor_actividad',
		'fecha_inicio_actividad',
		'fecha_aproximada_entrega_actividad',
		'fecha_entrega_actividad',
		'id_proyecto',
		'habilitado'
	);
	public function usuarios_actividades(){
		return $this->belongsToMany('App\Usuarios','usuarios_actividades','id_usuario','id_actividad');
	}
	public function subActividades(){
		return $this->hasMany('App\SubActividades','id_actividad');
	}
	public function comentarios(){
		return $this->hasMany('App\Comentarios','id_actividad');
	}
	public function proyecto(){
		return $this->belongsTo('App\Proyectos','id_proyecto');
	}
}
