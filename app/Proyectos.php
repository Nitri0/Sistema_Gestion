<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Roles;
use App\Etapas;
use Auth;
use Carbon\Carbon;

class Proyectos extends Model {

	protected $table = "t_proyectos";
	protected $primaryKey = "id_proyecto";
	protected $fillable = array('id_cliente',
								'id_grupo_etapas',
								'nombre_proyecto',
								'estatus_proyecto'
								);
	protected $dates = ['fecha_creacion_proyecto'];
	public $timestamps = false;

	public function getEstatus(){
		$etapa = Etapas::where('id_grupo_etapas',$this->id_grupo_etapas)->
						where('numero_orden_etapa', $this->estatus_proyecto)->first();
		if (!$etapa){
			return "Finalizado";
		}
		
		return $etapa->nombre_etapa;
	}

	public function getIdEtapa(){
		$etapa = Etapas::where('id_grupo_etapas',$this->id_grupo_etapas)->
						where('numero_orden_etapa', $this->estatus_proyecto)->first();
		return $etapa->id_etapa;
	}

	public function getCliente(){
		return Clientes::find($this->id_cliente);
	}

	public function getNombreDominio(){
		$dominio = Dominios::where('id_proyecto',$this->id_proyecto)->first();
		if ($dominio){
			return $dominio->nombre_dominio;
		};
		return "No asignado";
	}

	public function getUltimoAvance(){
		$avance = Avances::where('id_proyecto',$this->id_proyecto)->orderBy('fecha_creacion_avance', 'desc')->first();

		if ($avance){
			//return Carbon::now('VET'); ->zona horaria de venezuela
			Carbon::setLocale('es');
			return $avance->fecha_creacion_avance->diffForHumans();
		}
		return "Sin avances";
	}

	public function getRol(){
		$rol = Roles::where('id_proyecto',$this->id_proyecto)->where('id_usuario', Auth::user()->id_usuario)->first();
		return $rol->getRolName();
	}
}
