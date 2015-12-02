<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Perfil;
use App\MMEmpresasUsuarios;
use App\Excepciones;
use Gate;
use Auth;
use Session;



class AdministradorUsuariosController extends Controller
{

    public function __construct(){
        $this->usuario ="";
        $this->perfil ="";
        $this->permisos ="";
        $this->beforeFilter('@permisos');
        $this->beforeFilter('@find', ['only' => ['show','update','edit','destroy']]);
        $this->beforeFilter('@metodosClases', ['only' => ['create','edit']]);
    }

    public function find(Route $route){
        $this->usuario = User::find($route->getParameter('admin_usuarios'));
    }

    public function metodosClases(Route $route){
        $controladores = ['\App\Http\Controllers\ClientesController'                =>'clientes',
                          '\App\Http\Controllers\DominiosController'                =>'dominios',
                          '\App\Http\Controllers\EmpresasProveedorasController'     =>'empresas_proveedoras',
                          '\App\Http\Controllers\EtapasController'                  =>'grupo_etapas',
                          '\App\Http\Controllers\PlantillasController'              =>'plantillas',
                          '\App\Http\Controllers\ProyectosController'               =>'proyectos',
                          '\App\Http\Controllers\AdministradorEmpresasController'   =>'admin_empresas',
                          '\App\Http\Controllers\TipoProyectoController'            =>'tipo_proyectos'];

        $this->tipos_usuario = [
                                'Trabajador'    =>1,
                                'Invitado'      =>4,
                                'Socio'         =>3,
                                'Administrador' =>2,
                            ];
        $metodos_except = ['__construct',
                            'find',
                            'permisos',
                            'metodosClases'];
        $permisos = [];


        foreach($controladores as $controlador=>$nombre){
            $metodos = [];
            $class = new \ReflectionClass($controlador);
            foreach($class->getMethods(\ReflectionMethod::IS_PUBLIC ) as $route){
                if ($route->class == substr($controlador,1) && !in_array($route->name, $metodos_except) ){

                    array_push($metodos, $route->name);
                }
            };
            
            $permisos[$nombre] = $metodos;
        };
        //dd($permisos);
        $this->permisos = $permisos;
    }

    public function permisos(Route $route){
        if(Gate::denies('AdministradorUsuarios') ){
            Session::flash("mensaje-error","No tiene permisos para acceder al modulo: ".$route->getName());
            return redirect('/mis-proyectos');
        };
    }



    public function index(){
        //->get()->pluck('modulo_excepcion')->toArray();
        $idusuarios = MMEmpresasUsuarios::where('id_empresa', Auth::user()->getIdEmpresa())
                                            ->get()
                                            ->pluck('id_usuario')
                                            ->toArray();
        //dd( $idusuarios );
        $usuarios = User::whereIn('id_usuario',$idusuarios)->get();
        
        return view('administrador_usuarios.list',compact('usuarios'));
    }

    public function create(){

        return view('administrador_usuarios.create', ['usuario'=>$this->usuario,
                                                        'permisos' =>$this->permisos,
                                                        'tipos_usuario' =>$this->tipos_usuario,
                                                        'perfil'=>$this->perfil]);
    }

    public function store(Request $request){
        if (!$request->has('password')){
            Session::flash("mensaje-error",'rellene el password');
            return redirect("/admin_usuarios/create");
        };

        $verificacion = User::where('correo_usuario', $request->correo_usuario)->first();
        if ($verificacion){
            Session::flash("mensaje-error","usuario existente");
            return redirect("/admin_usuarios/create");
        };

        $request['password'] = \Hash::make($request['password']);
        $user = User::create($request->all());

        $request['id_usuario'] = $user->id_usuario;
        $perfil = Perfil::create($request->all());
        if ($request['clases']){
            foreach ($request['clases'] as $permiso=>$value ) {
                Excepciones::firstOrCreate([
                                    'id_usuario'=> $user->id_usuario,
                                    'id_empresa'=> Auth::user()->getIdEmpresa(),
                                    'modulo_excepcion'=>$permiso,]);
            }
        }

        MMEmpresasUsuarios::firstOrCreate([
                                'id_usuario' => $user->id_usuario,
                                'id_empresa' => Auth::user()->getIdEmpresa()
                                ]);

        //dd($permisos = Excepciones::where('id_usuario', $user->id_usuario)->get());
        Session::flash("mensaje-success","Usuario creado exitosamente");
        return redirect("/admin_usuarios");
    }

    public function show($id){
        return view('administrador_usuarios.detalle', ['usuario'=>$this->usuario,]);
    }

    public function edit($id){
        $this->perfil = Perfil::where('id_usuario',$id)->get()->first();
        $excepciones = Excepciones::where('id_usuario' , $id)->get()->pluck('modulo_excepcion');
        $permisos =[];
        foreach($excepciones as $excepcion){

           $permisos[$excepcion]=true;
        }
        //dd($permisos);
        return view('administrador_usuarios.create',['usuario'=>$this->usuario,
                                                     'permisos' =>$this->permisos,
                                                     'permisos_user' =>json_encode($permisos),
                                                     'tipos_usuario' =>$this->tipos_usuario,
                                                     'perfil'=>$this->perfil]);
    }

    public function update(Request $request, $id){

        $user = User::find($id);
        if ($request->has('password')){
            $request['password'] = \Hash::make($request['password']);
            $user->fill($request->all());
        }else{
            $user->fill($request->except('password'));
        };

        MMEmpresasUsuarios::firstOrCreate([
                                        'id_usuario' => $user->id_usuario,
                                        'id_empresa' => Auth::user()->getIdEmpresa()
                                        ]);
        
        $user->save();
        $perfil = Perfil::where('id_usuario',$user->id_usuario)->get()->first();
        $perfil->fill($request->all());
        $perfil->save();
        
        if ($request['clases']){
            $permisos = Excepciones::where('id_usuario', $user->id_usuario)->delete();
            foreach ($request['clases'] as $permiso=>$value ) {
                Excepciones::firstOrCreate([
                                    'id_usuario'=>$user->id_usuario,
                                    'id_empresa'=> Auth::user()->getIdEmpresa(),
                                    'modulo_excepcion'=>$permiso,]);
            }
        };
        Session::flash("mensaje-success","Usuario actualizado exitosamente");    
        return redirect("/admin_usuarios");
    }

    public function destroy($id){
        return redirect("/admin_usuarios");
    }
}
