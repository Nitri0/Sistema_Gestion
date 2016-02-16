<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
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

        $proyectos=Proyectos::all()->where('id_usuario',Auth::user()->id_usuario);
        $proyectos->each(function($proyectos){
            $proyectos->actividades->each(function($proyectos){
                $proyectos->subActividades;
                $proyectos->comentarios;
                $proyectos->adjuntos;
            });
            $proyectos->usuarios->each(function($proyectos){
                $proyectos->usuario->perfil;
            });
        });
        /*$actividades= Actividades::all();
        $actividades->each(function($actividades){
            $actividades->subActividades;
            $actividades->comentarios;
            $actividades->adjuntos;
        });*/
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
                $actividad->comentarios;
                $actividad->adjuntos;
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function agregarComentario(Request $request){
        $comentario=new Comentarios($request->all());
        if($comentario->save()){
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
