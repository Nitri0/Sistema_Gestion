<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);



        #_______________________________ Modulo Proyectos ___________________________
        $gate->define('proyectos', function ($user, $method){
            $this->verificacion();
            //dd($user->validacionExcepciones($method));
            return $user->isSuperAdmin() || $user->isAdmin() || ($user->isSocio() && $user->validacionExcepciones($method));
        });
        #_______________________________ Modulo Roles ___________________________
        $gate->define('roles', function ($user, $method){
            $this->verificacion();
            return $user->isSuperAdmin() || $user->isAdmin() || ($user->isSocio() && $user->validacionExcepciones($method));
        });

        #_______________________________ Modulo Dominios ____________________________
        $gate->define('dominios', function ($user, $method){
            $this->verificacion();
            return $user->isSuperAdmin() || $user->isAdmin() || ($user->isSocio() && $user->validacionExcepciones($method));
        });        
        #_______________________________ Modulo Clientes ____________________________
        $gate->define('clientes', function ($user, $method){
            $this->verificacion();
            return $user->isSuperAdmin() || $user->isAdmin() || ($user->isSocio() && $user->validacionExcepciones($method));
        });    
        #___________________________ Modulo Empresas Proveedoras ____________________
        $gate->define('empresasProveedoras', function ($user, $method){
            $this->verificacion();
            return $user->isSuperAdmin() || $user->isAdmin() || ($user->isSocio() && $user->validacionExcepciones($method));
        });    
        #_________________________________ Modulo Etapas ____________________________
        $gate->define('etapas', function ($user, $method){
            $this->verificacion();
            return $user->isSuperAdmin() || $user->isAdmin() || ($user->isSocio() && $user->validacionExcepciones($method));
        });    
        #______________________________ Modulo Plantillas ___________________________
        $gate->define('plantillas', function ($user, $method){
            $this->verificacion();
            return  $user->isSuperAdmin() || $user->isAdmin() || ($user->isSocio() && $user->validacionExcepciones($method));
        });  
        #_________________________________ Modulo Tipos de Proyecto ____________________________
        $gate->define('tipo_proyectos', function ($user, $method){
            $this->verificacion();
            return  $user->isSuperAdmin() || $user->isAdmin() || ($user->isSocio() && $user->validacionExcepciones($method));
        });
        #_________________________________ Modulo Etapas ____________________________
        $gate->define('AdministradorUsuarios', function ($user){
            $this->verificacion();
            return $user->isSuperAdmin() || $user->isAdmin();
        });
        #_________________________________ Modulo Administrar Empresas ____________________________
        $gate->define('admin_empresas', function ($user){
            $this->verificacion();
            return  $user->isSuperAdmin();
           // return  $user->isAdmin();
        });
    }

    public function verificacion(){
        if (Auth::user()->validacionVencimiento()){
            Auth::logout();
        };
    }
}