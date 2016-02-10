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
        $actividades= Actividades::all();
        $actividades->each(function($actividades){
            $actividades->subActividades;
            $actividades->comentarios;
        });
        return view('actividades.list',array('actividades'=>json_encode($actividades)));
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
    public function agregarAdjunto(request $request){
        $tempDir = '../public/adjuntos';
        if (!file_exists($tempDir)) {
            mkdir($tempDir);
        }
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $chunkDir = $tempDir . DIRECTORY_SEPARATOR . $_GET['flowIdentifier'];
            $chunkFile = $chunkDir.'/chunk.part'.$_GET['flowChunkNumber'];
            if (file_exists($chunkFile)) {
                header("HTTP/1.0 200 Ok");
            } else {
                header("HTTP/1.1 204 No Content");
            }
        }
        dd($request->all());

    }
}
