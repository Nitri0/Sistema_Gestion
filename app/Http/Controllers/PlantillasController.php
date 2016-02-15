<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Route;
use Illuminate\Http\Request;
use App\Plantillas;
use App\Proyectos;
use App\Clientes;
use App\Dominios;
use Session;
use Auth;
use Gate;

# ruta de la posicion de las plantillas de email
define ('SITE_EMAILS', realpath("../resources/views/emails/"));
define ('FOOTER', "<br><br><p align='center'>Mensaje enviado a través de la plataforma de gestión de proyectos <a href={{url()}}>KeyGestión</a>. Todos los derechos reservados 2016<p>");

class PlantillasController extends Controller {

	public function __construct(){
		$this->beforeFilter('@permisos');
		$this->beforeFilter('@find', ['only' => ['show','update','edit','destroy','previewPlantillas']]);
	}

	#______________________________ Filtros _________________________________
	public function find(Route $route){
		//dd($route->parameters());
		$this->plantillas = Plantillas::where('id_plantilla',$route->getParameter('plantillas'))
									->where('id_empresa', Auth::user()->getIdEmpresa())
									->first();

		if(!$this->plantillas){
			return redirect('/plantillas');
		}	
	}

	public function permisos(Route $route){
		if(Gate::denies('plantillas', $route->getName()) ){
			Session::flash("mensaje-error","No tiene permisos para acceder al modulo: ".$route->getName());
			return redirect('/mis-proyectos');
		};
	}

	#______________________________ Metodos _________________________________

	public function index(){
		$plantillas = json_encode(
								Plantillas::where('id_empresa',Auth::user()->getIdEmpresa())
										->where('habilitado_plantilla',1)
										->orderBy('id_plantilla', 'des')
										->get()
									);
		return view('plantillas.list',compact('plantillas'));
	}

	public function create(){
		$plantilla="";
		return view('plantillas.create')->with('plantillas',$plantilla);
	}

	public function edit($id){
		return view('plantillas.create')->with('plantillas',$this->plantillas);
	}

	public function store(Request $request){
		$request['id_empresa']=Auth::user()->getIdEmpresa();
		$request['id_usuario']=Auth::user()->id_usuario;
		$request['nombre_plantilla']= trim($request['nombre_plantilla']);
		$request['nombre_archivo_plantilla']= Auth::user()->id_usuario.\Carbon\Carbon::now();
		$plantillas = Plantillas::create($request->all());
        $path = SITE_EMAILS."/".$request->nombre_archivo_plantilla.".blade.php";
		file_put_contents($path,$request->raw_data_plantilla.FOOTER);


		return redirect('/plantillas');
	}	

	public function update(Request $request, $id){
		if (!$this->plantillas->nombre_archivo_plantilla){
			$request['nombre_archivo_plantilla'] = Auth::user()->id_usuario.\Carbon\Carbon::now();
		};
		$this->plantillas->fill($request->except('_method'));
		$this->plantillas->save();
		//Plantillas::where('id_plantilla',$id)->update($request->except('_method'));

		$path = SITE_EMAILS."/".$this->plantillas->nombre_archivo_plantilla.".blade.php";
		dd($this->plantillas->raw_data_plantilla.FOOTER);
		file_put_contents($path,$this->plantillas->raw_data_plantilla.FOOTER);
		return redirect('/plantillas');
	}	

	public function previewPlantillas($id_plantilla){
		//dd($id_plantilla, $id_proyecto);
		$plantilla = $this->plantillas;
		$proyecto = new Proyectos();
		$proyecto->nombre_proyecto = "PROYECTO_DE_PRUEBA";

		$cliente = new Clientes();
		$cliente->nombre_cliente = "CLIENTE_DE_PRUEBA";
		$cliente->ci_rif_cliente = "CI/RIF_DE_PRUEBA";
		$cliente->telefono_cliente = "TELEFONO_DE_PRUEBA";
		$cliente->telefono_2_cliente = "TELEFONO_2_DE_PRUEBA";
		$cliente->direccion_cliente = "DIRECCION_DE_PRUEBA";
		$cliente->persona_contacto_cliente = "NOMBRE_CONTACTO_PRUEBA";
		$cliente->email_cliente = "EMAIL_DE_PRUEBA";

		$dominio = new Dominios();
		$dominio->nombre_dominio = "DOMINIO_DE_PRUEBA";
		$mis_datos = Auth::user()->getPerfil();
		$mi_correo = Auth::user()->correo_usuario;				
		$data = "<Strong>Aqui va la descripcion del mensaje</strong>";
		$nombre_plantilla = $plantilla->nombre_archivo_plantilla;
		if (!$nombre_plantilla){
			$nombre_plantilla = $plantilla->nombre_plantilla;
		}
		if (!file_exists(SITE_EMAILS."/".$nombre_plantilla.".blade.php")){
			$path = SITE_EMAILS."/".$nombre_plantilla.".blade.php";
			file_put_contents($path,$this->plantillas->raw_data_plantilla.FOOTER);
		}
		return view('emails.'.$nombre_plantilla,compact('proyecto','cliente','data','dominio','mis_datos','mi_correo'));

	}		

	public function destroy($id){
		$ruta = realpath(dirname("../resources/views/emails/."));
		if (!$this->plantillas->nombre_archivo_plantilla){
			if (file_exists($ruta."/".$this->plantillas->nombre_plantilla.".blade.php")){
				unlink($ruta."/".$this->plantillas->nombre_plantilla.".blade.php");
			}
		}else{
			if (file_exists($ruta."/".$this->plantillas->nombre_archivo_plantilla.".blade.php")){
				unlink($ruta."/".$this->plantillas->nombre_archivo_plantilla.".blade.php");
			}
		}
		$this->plantillas->delete();
		Session::flash("mensaje","Plantilla eliminada exitosamente");
		return redirect('/plantillas');
	}		
	//__________________________________END CRUD PLANTILLAS ____________________	
}


