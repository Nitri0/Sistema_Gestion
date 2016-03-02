<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\Tipo;
use App\Master;
use App\Proyectos;
use App\Empresas;
use App\Roles;
use App\Avances;
use App\AvanceComentarios;
use App\AdjuntoAvanceComentarios;
use App\Dominios;
use App\User;
use App\MMEmpresasUsuarios;
use Input;
use App\Perfil;
use App\Clientes;
use App\GrupoEtapas;
use App\Plantillas;
use Session;
use URL;
use Illuminate\Http\Request;
use Gate;


define ('SITE_EMAILS', realpath("../resources/views/emails/"));
define ('FOOTER', "<br><br><p align='center'>Mensaje enviado a través de la plataforma de gestión de proyectos <a href={{url()}}>GestiónList</a>. Todos los derechos reservados 2016<p>");


class MisProyectosController extends Controller {


	public function perfil(Request $request){
		$perfil = Perfil::where('id_usuario', $request->user()->id_usuario)->first();
		return view('mis_proyectos.perfil',['perfil'=>$perfil]);
	}

	public function postPerfil(Request $request){
		Perfil::where('id_usuario', $request->user()->id_usuario)->update($request->all());
		Session::flash('mensaje', 'Perfil actualizado exitosamente');
		return redirect("/mis-proyectos");
	}

	public function roles(){
		return view('mis_proyectos.rol');
	}

	public function postRoles(){
		$master = Master::where('nombre_maestro','Roles')->first();
		if(!$master){
			$master = Master::create(['nombre_maestro'=>'Roles']);
		}

		Tipo::create(['id_maestro'  => $master->id_maestro,
					  'nombre_tipo' => Input::get('nombre_tipo')]);

		Session::flash('mensaje', 'Rol creado exitosamente');
		return redirect("proyectos/create");	
	}	

	public function misProyectos(){
		$user = Auth::user();
		//FORMA DE LISTAR LAS COLUMNAS ESPECIFICAS COMO UN ARREGLO UNIDIMENCIONAL (SOLO VALUE)
		$proyectos = json_encode(\DB::select('CALL p_busquedas(?,?,?)',array('listar_mis_proyectos',$user->id_usuario, $user->getIdEmpresa())));
		// $proyectos_id = Roles::where('id_usuario',$user->id_usuario)->lists('id_proyecto');
		// $proyectos = Proyectos::where('habilitado_proyecto',1)
		// 						->whereIn('id_proyecto',$proyectos_id)
		// 						->orderBy('id_avance', 'asc')
		// 						->paginate(10);

		return view('mis_proyectos.list',compact('proyectos'));
	}


	public function detalleMisProyectos($id_proyecto){

		$proyecto = Proyectos::where('id_proyecto',$id_proyecto)
								->where('id_empresa', Auth::user()->getIdEmpresa())
								->first();

		if (!$proyecto && $id_proyecto){
			return redirect('/mis-proyectos');
		}
		$rol = Roles::where('id_proyecto',$id_proyecto)
						->where('id_empresa',Auth::user()->getIdEmpresa())
						->get();
	
		$etapas = GrupoEtapas::where('id_grupo_etapas',$proyecto->id_grupo_etapas)
								->where('id_empresa', Auth::user()->getIdEmpresa())
								->first();
		$user = Auth::user();
		
		$progress = number_format( (float)((int) ($proyecto->estatus_proyecto-1) *100 / (int) $etapas->cantidad_etapas), 1,".", "" );

		if ($progress<0){
			$progress=0.0;
		}
		/*
		if (!$rol){
			return redirect('mis-proyectos/');
		}
		*/
		
		return view('mis_proyectos.detalle_proyecto',compact('proyecto','id_proyecto', 'rol', 'etapas','progress' ));
	}

	//__________________________________ CRUD AVANCES ____________________
	public function avancesMisProyectos($id_proyecto){

		$avances  = Avances::where('id_proyecto',$id_proyecto)
								->where('id_empresa',$user->getIdEmpresa())
								->orderBy('id_proyecto', 'desc')->paginate(10);

		return view('avances.list',compact('avances', 'id_proyecto'));
	}

	public function createAvancesMisProyectos($id_proyecto){
		$user = Auth::user();

		$proyecto = Proyectos::where('id_proyecto',$id_proyecto)
								->where('id_empresa',$user->getIdEmpresa())
								->first();
		if (!$proyecto){
			Session::flash('mensaje-error', 'No tiene permisos para ver ese registro');
			return redirect('mis-proyectos');
		}

		$plantillas = Plantillas::where('id_empresa',$user->getIdEmpresa())
								->get();

		$etapas = GrupoEtapas::find($proyecto->id_grupo_etapas)->getEtapas();

		$dominio = Dominios::find($proyecto->id_dominio);
		$mis_datos = Auth::user()->getPerfil();
		$mi_correo = Auth::user()->correo_usuario;
		return view('avances.create',compact('id_proyecto','proyecto','plantillas','etapas', 'mi_correo', 'mis_datos', 'dominio'));
	}	

	public function postCreateAvancesMisProyectos(Request $request,$id_proyecto){
		$proyecto = Proyectos::where('id_proyecto',$id_proyecto)
								->where('id_empresa',Auth::user()->getIdEmpresa())
								->first();
		$tokenRespuesta=null;
		$statusToken=0;
		
		if (!$proyecto ){
			Session::flash('mensaje-error', 'No es posible registrar avances en ese proyecto');
			return redirect('mis-proyectos');
		}

		$dominio = Dominios::find($proyecto->id_dominio);
		$mis_datos = Auth::user()->getPerfil();
		$mi_correo = Auth::user()->correo_usuario;
		$cliente = Clientes::find($proyecto->id_cliente);

		if ($request->check_copia_cliente_avance){
			$plantilla = Plantillas::where('id_plantilla',$request->id_plantilla)
									->where('id_empresa',Auth::user()->getIdEmpresa())
									->first();	
			$tokenRespuesta=substr(md5(uniqid(rand(), true)), 20, 20);
			$statusToken=0;
			if (!$plantilla ){
				Session::flash('mensaje-error', 'No es posible utilizar esa plantilla');
				return redirect('mis-proyectos');
			}
			//echo $plantilla->raw_data_plantilla;
			$mensaje='<p>para responder este mensaje por favor haga click <a href="'.route("avances.avance.comentario",$tokenRespuesta).'">aqui</a></p><br><br> ';
			$footerPos=strpos($plantilla->raw_data_plantilla,'<footer');
			if($footerPos==false){
				//$footerPos=strpos($plantilla->raw_data_plantilla,'</body');
				$plantilla->raw_data_plantilla.=$mensaje;
			}else{
				$plantilla->raw_data_plantilla=substr_replace ( $plantilla->raw_data_plantilla ,$mensaje , $footerPos,0 );
			}

			$parametros_plantilla = ['proyecto'=>$proyecto,
									 'cliente' =>$cliente,
									 'dominio' =>$dominio,
									 'mis_datos' =>$mis_datos,
									 'mi_correo' =>$mi_correo,
									 'token'=>$tokenRespuesta,
									 'data'    =>$request->descripcion_avance];			
			$modelo_plantilla = $plantilla->nombre_archivo_plantilla;
			if (!$plantilla->nombre_archivo_plantilla){
				$modelo_plantilla = $plantilla->nombre_plantilla;
			};
			//if (!file_exists(SITE_EMAILS."/".$modelo_plantilla.".blade.php")){
			$modelo_plantilla = 'plantilla_'.time().'-'.$plantilla->id_plantilla;
			$path = SITE_EMAILS."/".$modelo_plantilla.".blade.php";
			file_put_contents($path,$plantilla->raw_data_plantilla.FOOTER);
			//};			

			
			Helper::SendEmail(
							$cliente->email_cliente,
							$cliente->persona_contacto_cliente,
							$request->asunto_avance,
							'emails.'.$modelo_plantilla,
							$parametros_plantilla
							);
		};
		$request['id_usuario'] = Auth::user()->id_usuario;
		$request['id_empresa'] = Auth::user()->getIdEmpresa();
		$request['id_proyecto'] = $id_proyecto;
		$request['token_avance'] = $tokenRespuesta;
		$request['status_token'] = $statusToken;
		Avances::firstOrCreate($request->except('check_cierre_etapa'));

		if ($request->check_cierre_etapa == 1){
			$bot_user = User::where('correo_usuario',"admin@admin.com")->first();
			if (!$bot_user){
				$id_usuario = Auth::user()->id_usuario;
			}else{
				$id_usuario = $bot_user->id_usuario;
			}
			$proyecto->estatus_proyecto = $proyecto->estatus_proyecto + 1;
			Avances::Create([
					'asunto_avance' 				=> 'Comienzo de nueva etapa.',
					'descripcion_avance' 			=> 'Comienzo de nueva etapa.',
					'id_empresa' 					=> Auth::user()->getIdEmpresa(),
					'id_usuario' 					=> $id_usuario,
					'id_proyecto' 					=> $id_proyecto,
					'id_etapa'	 					=> $proyecto->getIdEtapa(),
					'check_copia_cliente_avance' 	=> $request->check_copia_cliente_avance,
					'token_avance'					=> $tokenRespuesta,
					'status_token'					=> $statusToken,
				]);
		}

		$proyecto->save();

		Session::flash('mensaje', 'Avance creado exitosamente');
		return redirect('/mis-proyectos/'.$id_proyecto);
	}

	public function previewRealDataPlantillas( $id_proyecto,$id_plantilla){

		$plantilla = Plantillas::where('id_plantilla',$id_plantilla)
								->where('id_empresa',Auth::user()->getIdEmpresa())
								->first();

		$proyecto = Proyectos::where('id_proyecto',$id_proyecto)
								->where('id_empresa',Auth::user()->getIdEmpresa())
								->first();

		if (!$proyecto || !$plantilla){
			Session::flash('mensaje-error', 'No tiene permisos para ver ese registro');
			return redirect('mis-proyectos');
		}
		$cliente = Clientes::find($proyecto->id_cliente);
		$dominio = Dominios::find($proyecto->id_dominio);
		$mis_datos = Auth::user()->getPerfil();
		$mi_correo = Auth::user()->correo_usuario;		
		$data = "<Strong>Aqui va la descripcion del mensaje</strong>";

		$modelo_plantilla = $plantilla->nombre_archivo_plantilla;
		if (!$plantilla->nombre_archivo_plantilla){
			$modelo_plantilla = $plantilla->nombre_plantilla;
		};
		if (!file_exists(SITE_EMAILS."/".$modelo_plantilla.".blade.php")){
			$path = SITE_EMAILS."/".$modelo_plantilla.".blade.php";
			file_put_contents($path,$plantilla->raw_data_plantilla.FOOTER);
		};		
		return view('emails.'.$modelo_plantilla,compact('proyecto','cliente','data','dominio','mis_datos','mi_correo'));
	}		
	public function crearRespuestaAvance($token=null){	

		if($token){

			$avance=Avances::where('token_avance',$token)->first();
			//dd($avance);
			if($avance->status_token==0){
				//dd($avance);
				return view('avances.comentario')->with('avance',$avance->id_avance);

			}
		}
		return view('avances.comentario')->with('avance',false);

	}
	public function guardarRespuestaAvance(request $request){
		if($request){
			$AvanceComentario=new AvanceComentarios($request->all());
			if($AvanceComentario->save()){
				$avance=Avances::find($request->id_avance);
				$avance->status_token=1;
				if($avance->save()){
					return json_encode($AvanceComentario->id_avance_comentario);
				}
			}
			
		}
		return json_encode(false);
	}
	public function adjuntar(request $request){
       
        //
        $tempDir = public_path().'/adjuntos';
        if (!file_exists($tempDir)) {
            mkdir($tempDir);
        }
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $chunkDir = $tempDir . DIRECTORY_SEPARATOR . $request->flowIdentifier;
            $chunkFile = $chunkDir.'/chunk.part'.$request->flowChunkNumber; 
            //dd(file_exists($chunkFile));
            if (file_exists($chunkFile)) {
                header("HTTP/1.0 200 Ok");
            } else {
                header("HTTP/1.1 204 No Content");
            }
        }        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //dd($request);
            if(count($request->files)>0):
                foreach ($request->files as $file) {
                    $nombreImg=$this->__nombreAleatorio('comment_',$file->getClientOriginalExtension());
                    //$adjuntoTag=$this->__crearTag($file->getClientOriginalExtension());
                    $id_avance_comentario=$request->id_avance_comentario;                    
                    $file->move($tempDir,$nombreImg);
                    $adjunto=new AdjuntoAvanceComentarios();
                    $adjunto->ruta_adjunto_avance_comentario=$nombreImg;
                    $adjunto->id_avance_comentario=$id_avance_comentario;
                    if($adjunto->save()){
                        return json_encode($adjunto);
                    }
                }
            endif;
        }
        //return true;
        

    }
    private function __nombreAleatorio($prefijo='',$extension=null){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $random='';
        for ($i = 0; $i < 4; $i++) {
            $random .= $characters[rand(0, strlen($characters)-1)];
        }
        $nombre= $prefijo.$random.time().'.'.$extension;    

        return $nombre;
    }
	//__________________________________END CRUD AVANCES ____________________



	public function perfilEmpresa(Request $request){
		$relacion = MMEmpresasUsuarios::where('id_usuario',Auth::user()->id_usuario)->first();

		$empresa = Empresas::find( $relacion->id_empresa );
		//dd($empresa);
		return view('mis_proyectos.perfil_empresa',['empresa'=>$empresa]);
	}

	public function postPerfilEmpresa(Request $request){

		$relacion = MMEmpresasUsuarios::where('id_usuario',Auth::user()->id_usuario)->first();
		Empresas::find( $relacion->id_empresa )->update($request->all());
		//Perfil::where('id_usuario', $request->user()->id_usuario)->update($request->all());
		Session::flash('mensaje', 'Perfil actualizado exitosamente');
		return redirect("/mis-proyectos");
	}

	public function mostrar_tutorial(Request $request){
		$user = Auth::user();
		if ($user){
			return json_encode(['success'=>true, 'tutorial'=>$user->tutorial]);
		};
		return json_encode(['success'=>false]);
	}

	public function desactivar_tutorial(Request $request){
		$user = Auth::user();
		if ($user){
			$user->tutorial = 0;
			$user->save();
			return json_encode(['success'=>true,]);
		};
		return json_encode(['success'=>false]);
	}

}

