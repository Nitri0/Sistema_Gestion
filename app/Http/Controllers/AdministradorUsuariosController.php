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
        $this->configuracion = new ConfiguracionController();
        $this->usuario ="";
        $this->perfil ="";
        $this->permisos ="";
        $this->beforeFilter('@permisos');
        $this->beforeFilter('@find', ['only' => ['show','update','edit','destroy','habilitar']]);
        $this->beforeFilter('@metodosClases', ['only' => ['create','edit']]);
    }

    public function find(Route $route){
        $this->usuario = User::where('id_usuario',$route->getParameter('admin_usuarios'))
                                ->first();
        $this->relacion = MMEmpresasUsuarios::where('id_usuario',$route->getParameter('admin_usuarios'))
                                ->where('id_empresa',Auth::user()->getIdEmpresa())
                                ->first();

        //dd($this->usuario , $this->relacion, Auth::user());
        if(!$this->usuario || !$this->relacion){
            return redirect('/admin_usuarios');
        }                                
    }

    public function metodosClases(Route $route){
        $controladores = [
                          '\App\Http\Controllers\ProyectosController'               =>'proyectos',
                          '\App\Http\Controllers\ClientesController'                =>'clientes',
                          '\App\Http\Controllers\EtapasController'                  =>'tipo_proyectos',
                          '\App\Http\Controllers\PlantillasController'              =>'plantillas',
                          '\App\Http\Controllers\RolesController'                   =>'roles',
                        //  '\App\Http\Controllers\DominiosController'                =>'dominios',
                        //  '\App\Http\Controllers\EmpresasProveedorasController'     =>'empresas_proveedoras',
                          ];

        $nombre_metodos  = $this->configuracion->InfoModulos;
        //dd($nombre_metodos);
        $this->tipos_usuario = [
                                'Trabajador'    =>1,
                                'Invitado'      =>4,
                                'Socio'         =>3,
                                'Administrador' =>2,
                            ];
        $metodos_except = ['__construct',
                            'find',
                            'permisos',
                            'metodosClases',
                            'validRif'];

        $permisos = [];


        foreach($controladores as $controlador=>$nombre){
            $metodos = [];
            $metodos_procesados = [];
            $class = new \ReflectionClass($controlador);
            foreach($class->getMethods(\ReflectionMethod::IS_PUBLIC ) as $route){
                if ($route->class == substr($controlador,1) && !in_array($route->name, $metodos_except) ){

                    array_push($metodos, ['metodo_raw'=>$route->name,
                                          'metodo_process'=>$nombre_metodos[$nombre]['administrador_usuarios'][$route->name][0],
                                          'metodo_descripcion'=>$nombre_metodos[$nombre]['administrador_usuarios'][$route->name][1],
                                          'nombre_metodo' => $nombre,
                                          ]);
                    
                }
            };
            
            $permisos[$nombre_metodos[$nombre]['nombre_menu']] = $metodos;
//            dd($permisos);
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
        $usuarios = User::whereIn('id_usuario',$idusuarios)
                            
                            ->get();
        
        return view('administrador_usuarios.list',compact('usuarios'));
    }

    public function create(){
        return view('administrador_usuarios.create', ['usuario'=>$this->usuario,
                                                        'permisos' =>$this->permisos,
                                                        'tipos_usuario' =>$this->tipos_usuario,
                                                        'perfil'=>$this->perfil]);
    }

    public function store(Request $request){
        $user = Auth::user();
        $cantidad_usuarios = MMEmpresasUsuarios::where('id_empresa', Auth::user()->getIdEmpresa())
                        ->get()
                        ->count();
        if (!$user->tieneSuscripcion() || $cantidad_usuarios >= $user->cantidad_usuarios){
            Session::flash("mensaje-error",'upgrade-cuenta');
            return redirect("/admin_usuarios/");
        }

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
        $request['activado_usuario'] = 1;
        $request['id_permisologia'] = 3;
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
                                'id_empresa' => Auth::user()->getIdEmpresa(),
                                ]);

        Session::flash("mensaje-success","Usuario creado exitosamente");
        return json_encode(['success'=>true,]);
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
        $this->usuario->fill(['habilitado_usuario'=>0,]);
        $this->usuario->save();
        return redirect("/admin_usuarios");
    }

    public function habilitar($id){
        $this->usuario->fill(['habilitado_usuario'=>1,]);
        $this->usuario->save();
        return redirect("/admin_usuarios");
    }    

    public function validUser(Request $request){
        $json=[];
        $value = $request->value;
        $users = User::where('correo_usuario', $request->value)->first();
        if (!$users){
            $json=['isValid'=>true,
                   'value'=>$request->value];
        }else{
            $json=['isValid'=>false,
                   'value'=>$request->value];
        }
        return json_encode($json);
    }
}
