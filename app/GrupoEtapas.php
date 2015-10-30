<?php namespace App;

use App\Etapas;
use Illuminate\Database\Eloquent\Model;

class GrupoEtapas extends Model {

	protected $table = 't_grupo_etapas';
	protected $primaryKey = "id_grupo_etapas";
	public $timestamps = false;
	
	protected $fillable = array('nombre_grupo_etapas',
								'descripcion_grupo_etapas',
								'cantidad_etapas',
								);

	public function getEtapas(){
		return Etapas::where('id_grupo_etapas', $this->id_grupo_etapas)->get();
	}
}
