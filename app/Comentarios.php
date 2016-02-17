<?php

namespace App;

use App\Http\Controllers\ConfiguracionController;
use Illuminate\Database\Eloquent\Model;

class Comentarios extends Model{ 

    protected $table = "t_comentarios";
	protected $primaryKey = "id_comentario";
	protected $fillable = array(
		'contenido_comentario',
		'autor_comentario',
		'id_actividad',
		'id_usuario',
		'id_sub_actividad'
	);

	public function usuario(){
		return $this->belongsTo('App\User','id_usuario');
		
	}
}
