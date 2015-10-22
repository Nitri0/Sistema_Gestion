<?php namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model {
	
	protected $connection = 'permisologia';
	protected $table = "t_perfil";
	protected $primaryKey = "id_perfil";
	public $timestamps = false;
	protected $fillable = array('id_usuario',
								'nombre_perfil',
								'apellido_perfil',
								'cedula_perfil',
								'sexo_perfil',
								'fecha_nacimiento_perfil',
								'telefono_perfil',
								'direccion_perfil',
								'url_imagen_perfil',
								'portal_web_perfil');

	public function fullName(){
		if (!$this->nombre_perfil and !$this->apellido_perfil){
			return User::find($this->id_usuario)->correo_usuario;
			
		}
		return $this->nombre_perfil." ".$this->apellido_perfil;
	}

}
