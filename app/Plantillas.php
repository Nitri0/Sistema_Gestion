<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Plantillas;
class Plantillas extends Model {

	protected $table = "t_plantillas";
	protected $primaryKey = "id_plantilla";
	protected $fillable = array('nombre_plantilla',
								'raw_data_plantilla',
								'ur_plantilla',
								'id_empresa',
								'nombre_archivo_plantilla',
								'descripcion_plantilla');

	//public $cast = ['fecha_creacion_plantilla' 	=> 'datetime',];

	//protected $dates =['fecha_creacion_plantilla',];

	public $timestamps = false;


public function getFechaCreacionPlantillaAttribute(){
	$date = \Carbon\Carbon::parse($this->attributes['fecha_creacion_plantilla']); 
  	return $date->format('d-m-Y');
//    return $this->attributes['fecha_creacion_plantilla'];
}


	public function getRawData($id){
		return Plantillas::find($id)->raw_data_plantilla;
	}

}
