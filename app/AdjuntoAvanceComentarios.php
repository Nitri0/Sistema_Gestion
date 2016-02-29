<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdjuntoAvanceComentarios extends Model
{
    //
    protected $table = "t_adjunto_avance_comentarios";
	protected $primaryKey = "id_adjunto_avance_comentario";
	public $timestamps = false;
	protected $fillable = array(
		'ruta_adjunto_avance_comentario',
		'id_avance_comentario'
	);

	public function avance(){
		return $this->belongsTo('App\AvanceComentarios','id_avance_comentario');
	}
}
