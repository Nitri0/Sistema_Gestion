<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adjuntos extends Model {

	protected $table = "t_adjuntos";
	protected $primaryKey = "id_adjunto";
	protected $fillable = array(
		'descripcion_adjunto',
		'tag_adjunto',
		'url_adjunto',
		'tipo_adjunto',
		'id_actividad',
		'id_sub_actividad',
		'id_comentario',
		'habilitado'
	);
}
