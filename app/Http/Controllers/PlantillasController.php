<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Plantillas;
use App\Proyectos;
use App\Clientes;
use App\Dominios;
use Session;
use Auth;

define ('SITE_EMAILS', realpath("../resources/views/emails/"));

class PlantillasController extends Controller {

	//__________________________________ CRUD PLANTILLAS ____________________

	public function index(){
		$plantillas = Plantillas::where('habilitado_plantilla',1)->paginate(10);
		return view('plantillas.list',compact('plantillas'));
	}

	public function create(){
		$plantilla="";
		return view('plantillas.create')->with('plantillas',$plantilla);
	}

	public function edit($id){
		$plantilla="";
		if ($id){
			$plantilla = Plantillas::find($id);
		}
		return view('plantillas.create')->with('plantillas',$plantilla);
	}

	public function store(Request $request){
		$plantillas = Plantillas::create($request->all());
        //$url = "uploads/temp/";
        $path = SITE_EMAILS."/".$request->nombre_plantilla.".blade.php";
		file_put_contents($path,$request->raw_data_plantilla);

		return redirect('/plantillas');
	}	

	public function update(Request $request, $id){

		Plantillas::where('id_plantilla',$id)->update($request->except('_method'));
		$path = SITE_EMAILS."/".$request->nombre_plantilla.".blade.php";
		file_put_contents($path,$request->raw_data_plantilla);
		if (Session::has('history-back')){
			return redirect(Session::get('history-back'));
		}
		return redirect('/plantillas');
	}	

	public function previewPlantillas($id_plantilla){
		//dd($id_plantilla, $id_proyecto);
		$plantilla = Plantillas::find($id_plantilla);
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
		return view('emails.'.$plantilla->nombre_plantilla,compact('proyecto','cliente','data','dominio','mis_datos','mi_correo'));
	}	

	public function previewRealDataPlantillas( $id_proyecto,$id_plantilla){
		//dd($id_plantilla, $id_proyecto);
		$plantilla = Plantillas::find($id_plantilla);
		$proyecto = Proyectos::find($id_proyecto);
		$cliente = Clientes::find($proyecto->id_cliente);
		$dominio = Dominios::find($proyecto->id_dominio);
		$mis_datos = Auth::user()->getPerfil();
		$mi_correo = Auth::user()->correo_usuario;		
		$data = "<Strong>Aqui va la descripcion del mensaje</strong>";
		return view('emails.'.$plantilla->nombre_plantilla,compact('proyecto','cliente','data','dominio','mis_datos','mi_correo'));
	}		
	//__________________________________END CRUD PLANTILLAS ____________________	
}


