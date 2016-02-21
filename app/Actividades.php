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
	public function usuarios(){
		return $this->belongsToMany('App\User','t_usuarios_actividades','id_actividad','id_usuario');
	}
	public function subActividades(){
		return $this->hasMany('App\SubActividades','id_actividad');
	}
	public function comentarios(){
		return $this->hasMany('App\Comentarios','id_actividad');
	}
	public function adjuntos(){
		return $this->hasMany('App\Adjuntos','id_actividad');
	}
	public function proyecto(){
		return $this->belongsTo('App\Proyectos','id_proyecto');
	}
}
