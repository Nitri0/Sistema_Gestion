<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Plantillas;
class Plantillas extends Model {

	protected $table = "t_plantillas";
	protected $primaryKey = "id_plantilla";
	protected $fillable = array('nombre_plantilla',
								'raw_data_plantilla',
								'ur_plantilla',
								'descripcion_plantilla');
	public $timestamps = false;


	public function getRawData($id){
		return Plantillas::find($id)->raw_data_plantilla;
	}

}
