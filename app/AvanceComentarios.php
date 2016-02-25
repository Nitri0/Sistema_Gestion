<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AvanceComentarios extends Model
{
    //
    protected $table = "t_avance_comentarios";
	protected $primaryKey = "id_avance_comentario";
	protected $fillable = array(
		'contenido_avance_comentario',
		'id_avance'
	);

	public function avance(){
		return $this->belongsTo('App\Avances','id_avance');
	}

	public function adjuntos(){
		return $this->hasMany('App\AdjuntoAvanceComentarios','id_avance_comentario');
	}
}
