<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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
            return  $user->isAdmin() || ($user->isSocio() && in_array($method,$user->getSocioExcepcions()) );
        });

        #_______________________________ Modulo Dominios ____________________________
        $gate->define('dominios', function ($user, $method){
            return  $user->isAdmin() || ($user->isSocio() && in_array($method,$user->getSocioExcepcions()) );
        });        
        #_______________________________ Modulo Clientes ____________________________
        $gate->define('clientes', function ($user, $method){
            return  $user->isAdmin() || ($user->isSocio() && in_array($method,$user->getSocioExcepcions()) );
        });    
        #___________________________ Modulo Empresas Proveedoras ____________________
        $gate->define('empresasProveedoras', function ($user, $method){
            return  $user->isAdmin() || ($user->isSocio() && in_array($method,$user->getSocioExcepcions()) );
        });    
        #_________________________________ Modulo Etapas ____________________________
        $gate->define('etapas', function ($user, $method){
            return  $user->isAdmin() || ($user->isSocio() && in_array($method,$user->getSocioExcepcions()) );
        });    
        #______________________________ Modulo Plantillas ___________________________
        $gate->define('plantillas', function ($user, $method){
            return  $user->isAdmin() || ($user->isSocio() && in_array($method,$user->getSocioExcepcions()) );
        });;    
        #_________________________________ Modulo Etapas ____________________________
        $gate->define('AdministradorUsuarios', function ($user){
            return  $user->isAdmin();
        });
        #_________________________________ Modulo Tipos de Proyecto ____________________________
        $gate->define('tipo_proyectos', function ($user){
            return  $user->isAdmin();
        });
    }
}