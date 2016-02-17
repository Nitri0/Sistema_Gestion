<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Roles;
use App\Proyectos;
use App\Actividades;
use App\SubActividades;
use App\Comentarios;
use App\Plantillas;
use App\Adjuntos;
use Session;
use Auth;
use Gate;

class ActividadesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //

        $proyectosActivos=Roles::all()->where('id_usuario',Auth::user()->id_usuario);//Auth::user()->id_usuario;
        $proyectosActivos->each(function($proyectosActivos){
            $proyectosActivos->proyectos;
            if($proyectosActivos->proyectos!=null){
                $proyectosActivos->proyectos->actividades->each(function($proyectosActivos){
                    $proyectosActivos->subActividades;                    
                    $proyectosActivos->adjuntos;
                    $proyectosActivos->comentarios->each(function($proyectosActivos){
                        $proyectosActivos->usuario->perfil;
                    });
                });
                $proyectosActivos->proyectos->usuarios->each(function($proyectos){
                    $proyectos->usuario->perfil;
                });
            }
        });        
        $proyectos=array();
        $arrayIds=array();

        foreach ($proyectosActivos as $key=>$proyecto) {
            $validation=false;
            foreach ($arrayIds as $id) {
                if($id == $proyecto->id_proyecto){
                    $validation=true;
                    break;
                }
            }
            if($validation){
                continue;
            }
            if($proyecto->proyectos != null){
                $arrayIds[]=$proyecto->id_proyecto;
                $proyectos[]=$proyecto->proyectos;
            }
        }
        return view('actividades.list',array('proyectos'=>json_encode($proyectos)));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $actividad="";
        return view('actividades.create')->with('actividades',$actividad);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
        if($request->typeActivity=="true"){
            if($actividad=Actividades::create($request->all())){
                $actividad->subActividades;
                $actividad->adjuntos;
                $actividad->comentarios->each(function($actividad){
                    $actividad->usuario->perfil;
                });
                return json_encode($actividad);
            }
        }else{
            if($subActividad=SubActividades::create($request->all())){
                return json_encode($subActividad);
            }
        }
        


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //dd($request->id_actividad);
        $actividad=Actividades::find($request->id_actividad);
        $actividad->fill($request->all());
        if($actividad->save()){
            return json_encode($actividad);
        }
        return json_encode(false);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(request $request){
        if($request->tipo){
            Adjuntos::where('id_actividad', $request->id_actividad)->delete();
            SubActividades::where('id_actividad', $request->id_actividad)->delete();
            Comentarios::where('id_actividad', $request->id_actividad)->delete();           
            Actividades::where('id_actividad', $request->id_actividad)->delete();
        }else{
            dd(SubActividades::where('id_actividad', $request->id_actividad)->delete());
        }
        return json_encode(true);
    }
    public function agregarComentario(Request $request){
        $comentario=new Comentarios($request->all());
        $comentario->id_usuario=Auth::user()->id_usuario;
        if($comentario->save()){
            $comentario->usuario->perfil;
            return json_encode($comentario);
        }
        //dd($comentario);
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
                    $nombreImg=$this->__nombreAleatorio('adjunto_',$file->getClientOriginalExtension());
                    $adjuntoTag=$this->__crearTag($file->getClientOriginalExtension());
                    $activity_id=$request->activiti_id;                    
                    $file->move($tempDir,$nombreImg);
                    $adjunto=new Adjuntos();
                    $adjunto->url_adjunto=$nombreImg;
                    $adjunto->id_actividad=$activity_id;
                    $adjunto->tipo_adjunto=$file->getClientOriginalExtension();
                    $adjunto->tag_adjunto=$adjuntoTag;
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
            $random .= $characters[rand(0, strlen($characters))];
        }
        $nombre= $prefijo.$random.time().'.'.$extension;    

        return $nombre;
    }
    private function __crearTag($extention){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $tag = 'adjunto-';
        for ($i = 0; $i < 3; $i++) {
            $tag .= $characters[rand(0, strlen($characters))];
        }
        return $tag;
    }
}
