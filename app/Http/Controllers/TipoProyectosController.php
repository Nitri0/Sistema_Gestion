<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TipoProyectosController extends Controller{

    public function __construct(){
        $this->beforeFilter('@permisos');
        //$this->beforeFilter('@find', ['only' => ['show','update','edit','destroy']]);
    }

    public function find(Route $route){
        $this->cliente = Clientes::find($route->getParameter('clientes'));
    }

    public function permisos(Route $route){
        // FORMA DE OBTENER LOS METODOS DE UNA CLASE
        // $class = new \ReflectionClass($this);
        // $metodos = [];
        // foreach ($class->getMethods(\ReflectionMethod::IS_PUBLIC ) as $route){
        //  if ($route->class == 'App\Http\Controllers\ProyectosController'){
        //      array_push($metodos, $route->name);
        //  }
        // };
        // dd($metodos);
        if(Gate::denies('tipo-proyecto', $route->getName()) ){
            Session::flash("mensaje-error","No tiene permisos para acceder al modulo: ".$route->getName());
            return redirect('/mis-proyectos');
        };
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $dominios = json_encode(\DB::table('t_dominios')
                                    ->where('t_dominios.habilitado_dominio','=',1)
                                    ->leftJoin('t_proyectos', 't_proyectos.id_proyecto', '=', 't_dominios.id_proyecto')
                                    ->leftJoin('t_clientes', 't_clientes.id_cliente', '=', 't_proyectos.id_cliente')
                                    ->join('t_empresa_proveedora', 't_empresa_proveedora.id_empresa_proveedora', '=', 't_dominios.id_empresa_proveedora')
                                    ->orderBy('t_dominios.id_dominio','desc')
                                    ->get());
        $tipo_proyecto = json_encode(TipoProyectos::orderBy('id_tipo_proyecto', 'desc'));
        return view('clientes.list', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        //
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
}
