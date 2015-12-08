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
            Session::flash('mensaje-error', 'No puede acceder ese registro');
            return redirect('/admin_usuarios');
        }                                
    }

    public function metodosClases(Route $route){
        $controladores = ['\App\Http\Controllers\ClientesController'                =>'clientes',
                          '\App\Http\Controllers\DominiosController'                =>'dominios',
                          '\App\Http\Controllers\EmpresasProveedorasController'     =>'empresas_proveedoras',
                          '\App\Http\Controllers\EtapasController'                  =>'grupo_etapas',
                          '\App\Http\Controllers\PlantillasController'              =>'plantillas',
                          '\App\Http\Controllers\ProyectosController'               =>'proyectos',
                          //'\App\Http\Controllers\AdministradorEmpresasController'   =>'admin_empresas',
                          '\App\Http\Controllers\TipoProyectoController'            =>'tipo_proyectos'];

        $nombre_metodos = [

                        "dominios" =>
                                       [     "index"   => [
                                                            "Listar",
                                                            "Permite acceso a la pantalla donde se listan los registros",
                                                        ],
                                              "show"    => [
                                                            "Mostrar",
                                                            "Permite acceso a la pantalla donde se muestra el detalle de los registros",
                                                        ],
                                              "create"  =>  [
                                                            "Crear",
                                                            "Permite acceso a la pantalla donde se rellena el formulario de creacion de un registro",
                                                        ],
                                              "store"   =>  [
                                                            "Guardar",
                                                            "Permite acceso a crear un registro. (Requiere el permiso Crear)",
                                                        ],
                                              "edit"    =>  [
                                                            "Editar",
                                                            "Permite acceso a editar un registro.",
                                                        ],
                                              "update"  => [
                                                            "Actualizar",
                                                            "Permite acceso a actualizar un registro. (Requiere el permiso Editar)",
                                                        ],
                                              "destroy" => [
                                                            "Eliminar",
                                                            "Permite acceso a crear un registro. (Requiere el permiso Crear)",
                                                        ],
                                              "actualizarEspacioUsado" => [
                                                            "Actualizar espacio usado",
                                                            "",
                                                        ],
                                        ],

                        "clientes" =>
                                       [
                                            "index"   => [
                                                            "Listar",
                                                            "Permite acceso a la pantalla donde se listan los registros",
                                                        ],
                                              "show"    => [
                                                            "Mostrar",
                                                            "Permite acceso a la pantalla donde se muestra el detalle de los registros",
                                                        ],
                                              "create"  =>  [
                                                            "Crear",
                                                            "Permite acceso a la pantalla donde se rellena el formulario de creacion de un registro",
                                                        ],
                                              "store"   =>  [
                                                            "Guardar",
                                                            "Permite acceso a crear un registro. (Requiere el permiso Crear)",
                                                        ],
                                              "edit"    =>  [
                                                            "Editar",
                                                            "Permite acceso a editar un registro.",
                                                        ],
                                              "update"  => [
                                                            "Actualizar",
                                                            "Permite acceso a actualizar un registro. (Requiere el permiso Editar)",
                                                        ],
                                              "destroy" => [
                                                            "Eliminar",
                                                            "Permite acceso a crear un registro. (Requiere el permiso Crear)",
                                                        ],
                                        ],
                        
                        "plantillas" =>
                                       [     
                                            "index"   => [
                                                            "Listar",
                                                            "Permite acceso a la pantalla donde se listan los registros",
                                                        ],
                                              "show"    => [
                                                            "Mostrar",
                                                            "Permite acceso a la pantalla donde se muestra el detalle de los registros",
                                                        ],
                                              "create"  =>  [
                                                            "Crear",
                                                            "Permite acceso a la pantalla donde se rellena el formulario de creacion de un registro",
                                                        ],
                                              "store"   =>  [
                                                            "Guardar",
                                                            "Permite acceso a crear un registro. (Requiere el permiso Crear)",
                                                        ],
                                              "edit"    =>  [
                                                            "Editar",
                                                            "Permite acceso a editar un registro.",
                                                        ],
                                              "update"  => [
                                                            "Actualizar",
                                                            "Permite acceso a actualizar un registro. (Requiere el permiso Editar)",
                                                        ],
                                              "destroy" => [
                                                            "Eliminar",
                                                            "Permite acceso a crear un registro. (Requiere el permiso Crear)",
                                                        ],
                                              "previewPlantillas" => [
                                                            "Previsualizar plantillas",
                                                            "Permite mostrar la información de plantillas creadas. (Requiere el permiso Listar)",
                                                        ],
                                       ],
                        
                        "tipo_proyectos" =>
                                       [     
                                            "index"   => [
                                                            "Listar",
                                                            "Permite acceso a la pantalla donde se listan los registros",
                                                        ],
                                              "show"    => [
                                                            "Mostrar",
                                                            "Permite acceso a la pantalla donde se muestra el detalle de los registros",
                                                        ],
                                              "create"  =>  [
                                                            "Crear",
                                                            "Permite acceso a la pantalla donde se rellena el formulario de creacion de un registro",
                                                        ],
                                              "store"   =>  [
                                                            "Guardar",
                                                            "Permite acceso a crear un registro. (Requiere el permiso Crear)",
                                                        ],
                                              "edit"    =>  [
                                                            "Editar",
                                                            "Permite acceso a editar un registro.",
                                                        ],
                                              "update"  => [
                                                            "Actualizar",
                                                            "Permite acceso a actualizar un registro. (Requiere el permiso Editar)",
                                                        ],
                                              "destroy" => [
                                                            "Eliminar",
                                                            "Permite acceso a crear un registro. (Requiere el permiso Crear)",
                                                        ],
                                       ],     
                                                                 
                        "proyectos" =>
                                       [    
                                            "index"   => [
                                                            "Listar",
                                                            "Permite acceso a la pantalla donde se listan los registros",
                                                        ],
                                              "show"    => [
                                                            "Mostrar",
                                                            "Permite acceso a la pantalla donde se muestra el detalle de los registros",
                                                        ],
                                              "create"  =>  [
                                                            "Crear",
                                                            "Permite acceso a la pantalla donde se rellena el formulario de creacion de un registro",
                                                        ],
                                              "store"   =>  [
                                                            "Guardar",
                                                            "Permite acceso a crear un registro. (Requiere el permiso Crear)",
                                                        ],
                                              "edit"    =>  [
                                                            "Editar",
                                                            "Permite acceso a editar un registro.",
                                                        ],
                                              "update"  => [
                                                            "Actualizar",
                                                            "Permite acceso a actualizar un registro. (Requiere el permiso Editar)",
                                                        ],
                                              "destroy" => [
                                                            "Eliminar",
                                                            "Permite acceso a crear un registro. (Requiere el permiso Crear)",
                                                        ],
                                              "indexProyectosFinalizados" => [
                                                            "Listar proyectos finalizados",
                                                            "",
                                                        ],
                                              "finalizarProyecto" => [
                                                            "Finalizar proyectos",
                                                            "(Requiere el permiso Mostrar)",
                                                        ],
                                              "reiniciarProyecto" => [
                                                            "Re-Abrir proyecto",
                                                            "(Requiere el permiso Mostrar)",
                                                        ],
                                              "agregarIntegrante" => [
                                                            "Agregar integrantes a proyectos creados",
                                                            "(Requiere el permiso mostrar)",
                                                        ],
                                              "eliminarIntegrante" => [
                                                            "Eliminar integrantes de proyectos creados",
                                                            "(Requiere el permiso mostrar)",
                                                        ],
                                       ],

                        "grupo_etapas" =>
                                       [     
                                            "index"   => [
                                                            "Listar",
                                                            "Permite acceso a la pantalla donde se listan los registros",
                                                        ],
                                              "show"    => [
                                                            "Mostrar",
                                                            "Permite acceso a la pantalla donde se muestra el detalle de los registros",
                                                        ],
                                              "create"  =>  [
                                                            "Crear",
                                                            "Permite acceso a la pantalla donde se rellena el formulario de creacion de un registro",
                                                        ],
                                              "store"   =>  [
                                                            "Guardar",
                                                            "Permite acceso a crear un registro. (Requiere el permiso Crear)",
                                                        ],
                                              "edit"    =>  [
                                                            "Editar",
                                                            "Permite acceso a editar un registro.",
                                                        ],
                                              "update"  => [
                                                            "Actualizar",
                                                            "Permite acceso a actualizar un registro. (Requiere el permiso Editar)",
                                                        ],
                                              "destroy" => [
                                                            "Eliminar",
                                                            "Permite acceso a crear un registro. (Requiere el permiso Crear)",
                                                        ],
                                              ],
                              
                        "roles" =>
                                       [     
                                            "index"   => [
                                                            "Listar",
                                                            "Permite acceso a la pantalla donde se listan los registros",
                                                        ],
                                              "show"    => [
                                                            "Mostrar",
                                                            "Permite acceso a la pantalla donde se muestra el detalle de los registros",
                                                        ],
                                              "create"  =>  [
                                                            "Crear",
                                                            "Permite acceso a la pantalla donde se rellena el formulario de creacion de un registro",
                                                        ],
                                              "store"   =>  [
                                                            "Guardar",
                                                            "Permite acceso a crear un registro. (Requiere el permiso Crear)",
                                                        ],
                                              "edit"    =>  [
                                                            "Editar",
                                                            "Permite acceso a editar un registro.",
                                                        ],
                                              "update"  => [
                                                            "Actualizar",
                                                            "Permite acceso a actualizar un registro. (Requiere el permiso Editar)",
                                                        ],
                                              "destroy" => [
                                                            "Eliminar",
                                                            "Permite acceso a crear un registro. (Requiere el permiso Crear)",
                                                        ],
                                        ],

                        "empresas_proveedoras" =>
                                       [     
                                            "index"   => [
                                                            "Listar",
                                                            "Permite acceso a la pantalla donde se listan los registros",
                                                        ],
                                              "show"    => [
                                                            "Mostrar",
                                                            "Permite acceso a la pantalla donde se muestra el detalle de los registros",
                                                        ],
                                              "create"  =>  [
                                                            "Crear",
                                                            "Permite acceso a la pantalla donde se rellena el formulario de creacion de un registro",
                                                        ],
                                              "store"   =>  [
                                                            "Guardar",
                                                            "Permite acceso a crear un registro. (Requiere el permiso Crear)",
                                                        ],
                                              "edit"    =>  [
                                                            "Editar",
                                                            "Permite acceso a editar un registro.",
                                                        ],
                                              "update"  => [
                                                            "Actualizar",
                                                            "Permite acceso a actualizar un registro. (Requiere el permiso Editar)",
                                                        ],
                                              "destroy" => [
                                                            "Eliminar",
                                                            "Permite acceso a crear un registro. (Requiere el permiso Crear)",
                                                        ],
                                        ],

                              ];

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
            $metodos_procesados = [];
            $class = new \ReflectionClass($controlador);
            foreach($class->getMethods(\ReflectionMethod::IS_PUBLIC ) as $route){
                if ($route->class == substr($controlador,1) && !in_array($route->name, $metodos_except) ){

                    array_push($metodos, ['metodo_raw'=>$route->name,
                                          'metodo_process'=>$nombre_metodos[$nombre][$route->name][0],
                                          'metodo_descripcion'=>$nombre_metodos[$nombre][$route->name][1]
                                          ]);
                    
                }
            };
            
            $permisos[$nombre] = $metodos;
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
                                'id_empresa' => Auth::user()->getIdEmpresa(),
                                ]);

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
}
